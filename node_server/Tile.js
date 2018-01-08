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

module.exports = Tile;