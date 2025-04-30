function encodeResistorColors(ohmsString) {
    let ohm = ohmsString.split(" ")[0]
    let counter = 0;
    let multiply = 0;
    let output = "";
    const colors = ["black", "brown", "red", "orange", "yellow", "green", "blue", "violet", "gray", "white"]
    for (let i = 0; i < ohm.length; i++) {
        if (ohm[i] == '.') { multiply--; continue; }
        if (counter < 2) {
            console.log(!isNaN(ohm[i]))
            if (!isNaN(ohm[i])) {
                output += colors[parseInt(ohm[i])] + " ";
            } else {
            console.log(ohm[i].toUpperCase())
                switch(ohm[i]) {
                    case "K": multiply+= 3; break;
                    case "M": multiply+= 6; break;
                    default: multiply+= 1; break;
                }
            }
        } else {
            console.log(ohm[i])

            switch(ohm[i].toUpperCase()) {
                case "K": multiply+= 3; break;
                case "M": multiply+= 6; break;
                default: multiply+= 1; break;
            }
        }
        counter++;

    }
    output += colors[multiply] + " ";
    console.log("multiply: " + multiply)

    return output + "gold";
}

let c = encodeResistorColors("1M ohms")
console.log(c)