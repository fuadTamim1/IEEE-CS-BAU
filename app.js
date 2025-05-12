function mazeRunner(maze, directions) {
    const start_point = getIndex2D(maze, 2);
    const end_point = getIndex2D(maze, 3);
    let pointer = { x: start_point.x, y: start_point.y };
    console.log(start_point)
    console.log(end_point)
    for (const dir of directions) {
        switch (dir) {
            case "N":
                pointer.y--;
                break
            case "S":
                pointer.y++;
                break;
            case "E":
                pointer.x++;
                break;
            case "W":
                pointer.x--;
                break;
        }
        console.log(pointer)
        if (maze[pointer.y][pointer.x] == 1) return "Dead";
        if (maze[pointer.y][pointer.x] == 3) return "Finish";
    }
    return "Lost";
}

function getIndex2D(arr, target) {
    const row = arr.findIndex(row => row.includes(target));
    if (row === -1) return [-1, -1];
    const col = arr[row].indexOf(target);
    return { x: col, y: row };
}


var maze = [
    [1, 1, 1, 1, 1, 1, 1],
    [1, 0, 0, 0, 0, 0, 3],
    [1, 0, 1, 0, 1, 0, 1],
    [0, 0, 1, 0, 0, 0, 1],
    [1, 0, 1, 0, 1, 0, 1],
    [1, 0, 0, 0, 0, 0, 1],
    [1, 2, 1, 0, 1, 0, 1]];

console.log(mazeRunner(maze, ["N", "N", "N", "N", "N", "E", "E", "E", "E", "E"]));