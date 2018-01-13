<template>
    <div>
        <div>
            <h3 class="text-center">{{ title }}</h3>
        </div>
        <div class="game-zone-content">
            <div class="alert alert-success" v-if="showSuccess">
                <button type="button" class="close-btn" v-on:click="showSuccess=false">&times;</button>
                <strong>{{ successMessage }} &nbsp;&nbsp;&nbsp;&nbsp;<a v-show="gameEnded"
                                                                        v-on:click.prevent="restartGame">Restart</a></strong>
            </div>
            <div v-if="hidebtn">
                <center>
                    <button class="btn btn-primary btn-xs" v-on:click.prevent="startGame">Press Start!
                    </button>
                </center>
            </div>
            <div class="board" v-if="start">
                <div v-for="(piece, key) of boardGame.board">
                    <img v-bind:src="pieceImageURL(key)" v-on:click="clickPiece(piece)">
                </div>
            </div>
            <hr>
        </div>
    </div>
</template>

<script type="text/javascript">
    export default {
        props: ['currentUser'],
        data: function () {
            return {
                title: 'Memory Game',
                showSuccess: false,
                showFailure: false,
                successMessage: '',
                failMessage: '',
                gameEnded: false,
                currentValue: 0,
                boardGame: new Board(1),
                flippedTiles: [],
                playerMoves: 0,
                start: false,
                hidebtn: true,
                timer: null,
            }
        },
        methods: {
            pieceImageURL: function (key) {
                {
                    //console.log("draw tile");
                    return this.boardGame.board[key].pathToImage();
                }
            },
            clickPiece: function (piece) {
                if (!piece.hidden || this.gameEnded) {
                    return;
                }

                piece.flip();

                this.flippedTiles.push(piece);

                this.playerMoves++;

                if (this.playerMoves == 2) {
                    //AQUI
                    this.timer = setTimeout(() => {
                        this.clearTimer();
                        this.checkTilesEqual();

                        this.playerMoves = 0;
                        this.flippedTiles = [];
                    }, 500);


                    if (this.isBoardComplete()) {
                        this.gameEnded = true;
                        this.showSuccess = true;

                        this.successMessage = "You won!";
                    }

                }
                else {
                    // DO NOTHING
                }
            },

            // ----------------------------------------------------------------------------------------
            // GAME LOGIC - START
            // ----------------------------------------------------------------------------------------
            startGame: function () {
                this.start = true;
                this.hidebtn = false;

                this.saveNewGame();
            },

            checkTilesEqual: function () {
                if (this.flippedTiles[0].tileValue == this.flippedTiles[1].tileValue) {
                    //this.successMessage = "You got a pair!";
                    //this.showSuccess = true;

                    this.playerMoves = 0;
                    this.flippedTiles = [];

                } else {
                    this.flippedTiles[0].flip();
                    this.flippedTiles[1].flip();


                    //this.successMessage = "Not a pair";
                    //this.showSuccess = true;

                    this.playerMoves = 0;
                    this.flippedTiles = [];
                }
            },

            restartGame: function () {
                console.log('restartGame');
                this.showSuccess = false;
                this.showFailure = false;
                this.successMessage = '';
                this.failMessage = '';
                this.gameEnded = false;
                this.currentValue = 0;
                this.boardGame = new Board(1);
                this.flippedTiles = [];
                this.playerMoves = 0;
            },

            checkGameEnded: function () {

            },
            isBoardComplete: function () {
                let flag = true;

                this.boardGame.board.forEach(function (tile) {
                    if (tile.hidden) {
                        flag = false;
                        return;
                    }
                });
                return flag;
            },

            clearTimer() {
                clearTimeout(this.timer);
                this.timer = null;
            },
            // ----------------------------------------------------------------------------------------
            // GAME LOGIC - END
            // ----------------------------------------------------------------------------------------
            playerName: function (playerNumber) {

            },

            saveNewGame: function () {
                axios.post('api/createSingle', {
                    //ROTA QUANDO PROTEGIDA, PASSPORT DA ERRO NO POST
                   /* headers: {
                        'Authorization': 'Bearer ' + sessionStorage.getItem('token-user'),
                        'Content-Type': 'application/json',
                    },
                    */
                    'type': 'singleplayer',
                    'player1': this.currentUser.name,
                    'created_by': this.currentUser.id,
                    'total_players': 1,
                })
            },
        },
        computed: {},
        mounted() {

        }
    }


    /////CLASS BOARD
    class Board {
        constructor(player, x, y) {
            console.log("constructor");
            this.board = [];
            this.player = player;

            this.board = this.newBoard(4, 4);
            console.log(this.board);
        }

        newBoard(x, y) {
            console.log("new board");
            let length = x * y;
            let board = new Array(length);

            let tileValue = 0;
            let counter = 0;

            for (let i = 0; i < length; i++) {
                board[i] = new Tile(tileValue);
                counter++;

                if (counter == 2) {
                    counter = 0;
                    tileValue++;
                }
            }

            for (let i = 0; i < 500; i++) {
                let posOne = Math.floor(Math.random() * length);
                let posTwo = Math.floor(Math.random() * length);
                let aux = board[posOne];
                board[posOne] = board[posTwo];
                board[posTwo] = aux;


            }
            //console.log(board);
            return board;
        }
    }


    /////CLASS TILE
    class Tile {
        constructor(tileValue) {
            this.hidden = true;
            this.open = false;
            this.tileValue = tileValue;
            this.imgHidden = 'img/hidden.png';
            this.imgTile = 'img/' + String(this.tileValue) + '.png';
        }

        pathToImage() {
            if (this.hidden) {
                return this.imgHidden;
            }
            else {
                return this.imgTile;
            }
        }

        flip() {
            this.hidden = !this.hidden;
            this.open = true;
        }
    }
</script>

<style>
    .board {
        max-width: 368px;
        margin: 0 auto;
        border-style: solid;
        border-width: 0px 0 0 0px;
        border-color: black;
    }

    .board div {
        display: inline-block;
        border-style: solid;
        border-width: 2px 2px 2px 2px;
        border-color: black;
        margin-left: -2px;
        margin-top: -2px;
    }

    .board img {
        width: 80px;
        height: 80px;
        margin: 5px;
        padding: 0;
        border-style: none;
    }

</style>