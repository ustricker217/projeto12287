/////CLASS BOARD

var Tile = require('./Tile.js');

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

module.exports = Board;