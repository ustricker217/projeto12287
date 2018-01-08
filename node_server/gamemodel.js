/*jshint esversion: 6 */

var Board = require('./Board.js');

class MemoryGame {
    constructor(ID, player1Name) {
        this.gameID = ID;
        this.gameEnded = false;
        this.gameStarted = false;
        this.player1 = player1Name;
        this.player2 = '';
        this.playerTurn = 1;
        this.winner = 0;
        this.boardGame = new Board(2);
        this.flippedTiles = [];
        this.playerMoves = 0;
    }

    join(player2Name) {
        this.player2 = player2Name;
        this.gameStarted = true;
    }

    checkTilesEqual() {
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
    };

    checkGameEnded() {
        if (this.isBoardComplete()) {
            this.gameEnded = true;
            this.showSuccess = true;
            return true;
        }
        return false;
    };

    isBoardComplete() {
        let flag = true;

        this.boardGame.board.forEach(function (tile) {
            if (tile.hidden) {
                flag = false;
                return;
            }
        });
        return flag;
    };

    clearTimer() {
        clearTimeout(this.timer);
        this.timer = null;
    };

    play(playerNumber, index) {
        if (!this.gameStarted) {
            return false;
        }
        if (this.gameEnded) {
            return false;
        }
        if (playerNumber != this.playerTurn) {
            return false;
        }
        /*
        if (this.boardGame.board[index] !== 0) {
            return false;
        }
        */
        this.flip(index);

        this.playerMoves ++;

        if (this.playerMoves == 2) {
            this.checkTilesEqual();
            this.playerMoves = 0;
            if (!this.checkGameEnded()) {
                this.playerTurn = this.playerTurn == 1 ? 2 : 1;
            }
            return true;
        }
        return true;
    }

    flip(index) {
        this.boardGame.board[index].hidden = !this.boardGame.board[index].hidden;
        this.boardGame.board[index].open = true;
    }
}
module.exports = MemoryGame;
