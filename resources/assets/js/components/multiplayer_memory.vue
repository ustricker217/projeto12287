<template>
	<div>
        <div>
            <h3 class="text-center">{{ title }}</h3>
            <br>
            <h2>Current Player : {{ currentUser }}</h2>
            <hr>
            <h3 class="text-center">Lobby</h3>
            <p><button class="btn btn-xs btn-success" v-on:click.prevent="createGame">Create a New Game</button></p>
            <hr>
            <h4>Pending games (<a @click.prevent="loadLobby">Refresh</a>)</h4>
            <lobby :games="lobbyGames" @join-click="join"></lobby>
            <template v-for="game in activeGames">
                <game :game="game" :currentUser="currentUser"></game>
            </template>
        </div>
    </div>
</template>

<script type="text/javascript">
    import Lobby from './lobby.vue';
    import MemoryGame from './game-memory.vue';

	export default {
	    props:['currentUser', 'userId'],
        data: function(){
			return {
                title: 'Multiplayer Memory Game',
                currentPlayer: 'Player X',
                lobbyGames: [],
                activeGames: [],
                socketId: "",
            }
        },
        sockets:{
            connect(){
                console.log('socket connected');
                this.socketId = this.$socket.id;
            },
            discconnect(){
                console.log('socket disconnected');
                this.socketId = "";
            },
            lobby_changed(){
                this.loadLobby();
            },
            my_active_games_changed(){
                this.loadActiveGames();
            },
            my_active_games(games){
                console.log(games);
                this.activeGames = games;
            },
            my_lobby_games(games){
                this.lobbyGames = games;
               // console.log(games);
            },
            invalid_play(errorObject){
                if (errorObject.type == 'Invalid_Game') {
                    alert("Error: Game does not exist on the server");
                } else if (errorObject.type == 'Invalid_Player') {
                    alert("Error: Player not valid for this game");
                } else if (errorObject.type == 'Invalid_Play') {
                    alert("Error: Move is not valid or it's not your turn");
                } else {
                    alert("Error: " + errorObject.type);
                }

            },
            game_changed(game){
                for (var lobbyGame of this.lobbyGames) {
                    console.log(game);
                    if (game.gameID == lobbyGame.gameID) {
                        Object.assign(lobbyGame, game);
                        break;
                    }
                }
                for (var activeGame of this. activeGames) {
                    if (game.gameID == activeGame.gameID) {
                        Object.assign(activeGame, game);
                        break;
                    }
                }
            },
        },        
        methods: {
            loadLobby(){
                this.$socket.emit('get_my_lobby_games');
            },
            loadActiveGames(){
                this.$socket.emit('get_my_activegames');
            },
            createGame(){
                if (this.currentUser == "") {
                    alert('Current Player is Empty - Cannot Create a Game');
                    return;
                }
                else {
                    this.$socket.emit('create_game', { playerName: this.currentUser });
                    this.saveNewMultiplayerGame(this.currentUser.name);
                }
            },
            join(game){
                if (game.player1 == this.currentUser) {
                    alert('Cannot join a game because your name is the same as Player 1');
                    return;
                }
                this.$socket.emit('join_game', {gameID: game.gameID, playerName: this.currentUser });
                this.updateMultiplayerGame(game.gameID);
            },
            play(game, index){
                this.$socket.emit('play', {gameID: game.gameID, index: index });   
            },
            close(game){
                this.$socket.emit('remove_game', {gameID: game.gameID });   
            },

            saveNewMultiplayerGame: function () {
                console.log(this.currentUser);
                axios.post('api/createMulti', {
                    //ROTA QUANDO PROTEGIDA, PASSPORT DA ERRO NO POST
                    /* headers: {
                         'Authorization': 'Bearer ' + sessionStorage.getItem('token-user'),
                         'Content-Type': 'application/json',
                     },
                     */
                    'type': 'multiplayer',
                    'player1': this.currentUser,
                    'created_by': this.userId,
                    'total_players': 1,
                    contentType: 'application/json',
                })
            },

            //AQUI METODO NAO IMPLEMENTADO
            updateMultiplayerGame: function (gameID) {
                axios.put('api/updateMultiplayerGame'+ gameID,{

                })
            },
        },

        components: {
            'lobby': Lobby,
            'game': MemoryGame,
        },
        mounted() {
            this.loadLobby();
        }

    }
</script>

<style>	
    
</style>