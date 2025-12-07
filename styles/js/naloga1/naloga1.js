// Game state
const gameState = {
    location: 'laboratorij',
    inventory: {
        prvo_stevilko: false,
        drugo_stevilko: false,
        tretjo_stevilko: false
    },
    visitedRooms: {
        rdeca: false,
        modra: false,
        siva: false
    },
    waitingForInput: false,
    currentInputType: null,
    currentInputCallback: null
};

// Terminal elements (will be set in initGame)
let terminalOutput;
let terminalInput;

// Initialize game
function initGame() {
    // Get terminal elements
    terminalOutput = document.getElementById('terminal-output');
    terminalInput = document.getElementById('terminal-input');
    
    // Check if elements exist
    if (!terminalOutput || !terminalInput) {
        console.error('Terminal elements not found!');
        return;
    }
    
    addOutput('Dobrodošel/la v igro.');
    addOutput('Zbudiš se v temnem, hladnem laboratoriju.');
    addOutput('Luči utripajo, zrak smrdi po kemikalijah. Nespomniš se, kdo si in zakaj si tu.');
    addOutput('Pred tabo je računalnik, na katerem piše:"Eksperiment 67-A aktiviran."');
    addOutput('Navodila: Za izhod potrebuješ 3 številke.');
    addOutput('Ko obiščeš vse tri sobe in najdeš vse stevilke izberi Imam vse.');
    addOutput('');
    addOutput('Pritisni ENTER za začetek...');
    
    terminalInput.addEventListener('keypress', handleKeyPress);
    terminalInput.focus();
}

// Clear terminal output
function clearOutput() {
    if (terminalOutput) {
        terminalOutput.innerHTML = '';
    }
}

// Add output to terminal
function addOutput(text, className = '') {
    const line = document.createElement('div');
    line.className = 'terminal-line' + (className ? ' ' + className : '');
    line.textContent = text;
    terminalOutput.appendChild(line);
    terminalOutput.scrollTop = terminalOutput.scrollHeight;
}

// Handle key press
function handleKeyPress(e) {
    if (e.key === 'Enter') {
        e.preventDefault(); // Prevent form submission if input is in a form
        
        const command = terminalInput.value.trim();
        terminalInput.value = '';
        
        // Clear the screen before processing command (like cls in Windows)
        clearOutput();
        
        if (command) {
            addOutput('> ' + command);
            addOutput(''); // Empty line for spacing
            
            if (gameState.waitingForInput) {
                handleSpecialInput(command);
            } else {
                processCommand(command);
            }
        } else {
            // Show instructions if Enter is pressed with empty input
            showLocationContext();
        }
    }
}

// Process regular commands
function processCommand(command) {
    const cmd = command.toLowerCase();
    
    // Movement commands
    if (cmd === 'rdeca' || cmd === 'rdeča') {
        goToRedRoom();
    } else if (cmd === 'modra') {
        goToBlueRoom();
    } else if (cmd === 'siva') {
        goToGrayRoom();
    } else if (cmd === 'inventar') {
        showInventory();
    } else if (cmd === 'imam vse') {
        tryCode();
    } else if (cmd.startsWith('poberi ')) {
        const item = cmd.substring(7);
        if (item === 'številka' || item === 'stevilka') {
            addOutput('Uporabi ukaz za premik v sobo, kjer je številka.');
        } else {
            addOutput('Neznan predmet.');
        }
    } else {
        addOutput('Neznan ukaz. Poskusi znova.');
        showLocationContext();
    }
}

// Show instructions
function showInstructions() {
    addOutput('');
    addOutput('NAVODILA:');
    addOutput('Premik: vnesi "[vrata]"  (rdeča, modra, siva)');
    addOutput('Pobiranje: vnesi "poberi [predmet]" (številka)');
    addOutput('Inventar: vnesi "inventar"');
    addOutput('Ko imaš vse 3 številke: vnesi "imam vse"');
    addOutput('');
}

// Show current location and instructions
function showLocationContext() {
    addOutput('Trenutno si v: ' + gameState.location);
    addOutput('');
    showInstructions();
}

// Red room
function goToRedRoom() {
    gameState.location = 'rdeca vrata';
    gameState.visitedRooms.rdeca = true;
    
    addOutput('');
    addOutput('Vstopiš v prostor in vidiš, kako utripa rdeča luč.');
    addOutput('Na mizi je zvezek.');
    addOutput('V zvezku piše: Samo prava koda ustavi sistem.');
    addOutput('Spodaj, pa komaj vidno piše: PI na dve decimalki.');
    addOutput('');
    
    if (!gameState.inventory.prvo_stevilko) {
        addOutput('Vnesi odgovor:');
        gameState.waitingForInput = true;
        gameState.currentInputType = 'red_quiz';
    } else {
        addOutput('Že imaš prvo številko.');
        addOutput('');
        showLocationContext();
    }
}

// Blue room
function goToBlueRoom() {
    gameState.location = 'modra vrata';
    gameState.visitedRooms.modra = true;
    
    addOutput('');
    addOutput('Za vrati je soba polna računalnikov.');
    addOutput('En zaslon še deluje.');
    addOutput('Na njem piše: Samo znanje te lahko reši.');
    addOutput('Katero je glavno mesto Moldavije?');
    addOutput('');
    
    if (!gameState.inventory.drugo_stevilko) {
        addOutput('Vnesi odgovor:');
        gameState.waitingForInput = true;
        gameState.currentInputType = 'blue_quiz';
    } else {
        addOutput('Že imaš drugo številko.');
        addOutput('');
        showLocationContext();
    }
}

// Gray room
function goToGrayRoom() {
    gameState.location = 'siva vrata';
    gameState.visitedRooms.siva = true;
    
    addOutput('');
    addOutput('Za vrati te pričaka dolg, temen hodnik.');
    addOutput('Na koncu hodnika se vidi kovinski sef.');
    addOutput('Poleg njega pa sta dve stikali.');
    addOutput('Rdeče');
    addOutput('Zeleno');
    addOutput('Izberi stikalo');
    addOutput('');
    
    if (!gameState.inventory.tretjo_stevilko) {
        addOutput('Vnesi izbiro (rdeče/zeleno):');
        gameState.waitingForInput = true;
        gameState.currentInputType = 'gray_switch';
    } else {
        addOutput('Že imaš tretjo številko.');
        addOutput('');
        showLocationContext();
    }
}

// Handle special input (quizzes, choices)
function handleSpecialInput(input) {
    const lowerInput = input.toLowerCase();
    
    if (gameState.currentInputType === 'red_quiz') {
        if (lowerInput === '3.14') {
            addOutput('BRAVOOOOO odgovor je pravilen. Prva številka je 4.');
            gameState.inventory.prvo_stevilko = true;
            gameState.waitingForInput = false;
            gameState.currentInputType = null;
            addOutput('');
            showLocationContext();
        } else {
            addOutput('Narobe si odgovoril. Poskusi znova kasneje.');
            gameState.waitingForInput = false;
            gameState.currentInputType = null;
            addOutput('');
            showLocationContext();
        }
    } else if (gameState.currentInputType === 'blue_quiz') {
        if (lowerInput === 'kisinjev' || lowerInput === 'chișinău' || lowerInput === 'chisinau') {
            addOutput('BRAVOOOOO odgovor je pravilen. Druga številka je 7.');
            gameState.inventory.drugo_stevilko = true;
            gameState.waitingForInput = false;
            gameState.currentInputType = null;
            addOutput('');
            showLocationContext();
        } else {
            addOutput('Narobe si odgovoril. Poskusi znova kasneje.');
            gameState.waitingForInput = false;
            gameState.currentInputType = null;
            addOutput('');
            showLocationContext();
        }
    } else if (gameState.currentInputType === 'gray_switch') {
        if (lowerInput === 'zeleno' || lowerInput === 'zelena') {
            handleGreenSwitch();
        } else if (lowerInput === 'rdeče' || lowerInput === 'rdece' || lowerInput === 'rdeča' || lowerInput === 'rdeca') {
            handleRedSwitch();
        } else {
            addOutput('Hodnik postane strašen, bolje da se vrneš.');
            gameState.waitingForInput = false;
            gameState.currentInputType = null;
            addOutput('');
            showLocationContext();
        }
    } else if (gameState.currentInputType === 'red_corridor') {
        if (lowerInput === 'grem naprej' || lowerInput === 'naprej') {
            endGame(false);
        } else if (lowerInput === 'grem nazaj na varno' || lowerInput === 'nazaj' || lowerInput === 'nazaj na varno') {
            goBackToGray();
        } else {
            addOutput('Nauci se pravilno vpisovati ukaze');
            gameState.waitingForInput = false;
            gameState.currentInputType = null;
            addOutput('');
            showLocationContext();
        }
    } else if (gameState.currentInputType === 'code_input') {
        if (lowerInput === '472') {
            endGame(true);
        } else {
            endGame(false);
        }
    }
}

// Handle green switch
function handleGreenSwitch() {
    addOutput('');
    addOutput('Pritisnil si zeleno stikalo.');
    addOutput('Sef se odpre in iz njega pade kovinska ploščica.');
    addOutput('Na kateri piše "Zadnja številka je 2"');
    gameState.inventory.tretjo_stevilko = true;
    gameState.waitingForInput = false;
    gameState.currentInputType = null;
    addOutput('');
    showLocationContext();
}

// Handle red switch
function handleRedSwitch() {
    addOutput('');
    addOutput('Svetloba se kar naenkrat spremeni vidiš le malo svetlobe');
    addOutput('na koncu rdečega hodnika.');
    addOutput('Ali si upaš razskirati vse kar imaš in iti naprej?');
    addOutput('Grem naprej');
    addOutput('Grem nazaj na varno');
    addOutput('');
    addOutput('Izberi:');
    gameState.waitingForInput = true;
    gameState.currentInputType = 'red_corridor';
}

// Go back to gray room
function goBackToGray() {
    addOutput('');
    addOutput('Zelo pametno si se odločil');
    addOutput('Prišel si nazaj do sivih vrat.');
    addOutput('Ponovno si izberi stikalo.');
    addOutput('Sedaj poskusiš pritisniti še zeleno stikalo.');
    addOutput('');
    addOutput('Vnesi izbiro (rdeče/zeleno):');
    gameState.waitingForInput = true;
    gameState.currentInputType = 'gray_switch';
}

// Show inventory
function showInventory() {
    addOutput('');
    addOutput('Imaš:');
    if (gameState.inventory.prvo_stevilko) {
        addOutput('- Prva številka je 4');
    }
    if (gameState.inventory.drugo_stevilko) {
        addOutput('- Druga številka je 7');
    }
    if (gameState.inventory.tretjo_stevilko) {
        addOutput('- Tretja številka je 2');
    }
    if (!gameState.inventory.prvo_stevilko && !gameState.inventory.drugo_stevilko && !gameState.inventory.tretjo_stevilko) {
        addOutput('- Nič');
    }
    addOutput('');
    showLocationContext();
}

// Try code
function tryCode() {
    const hasAll = gameState.inventory.prvo_stevilko && 
                   gameState.inventory.drugo_stevilko && 
                   gameState.inventory.tretjo_stevilko;
    
    if (!hasAll) {
        addOutput('Še nimaš vseh treh številk!');
        showInventory();
        return;
    }
    
    addOutput('');
    addOutput('Samo pravilna koda te lahko še reši.(vse številke napiši skupaj)');
    addOutput('Vnesi kodo:');
    gameState.waitingForInput = true;
    gameState.currentInputType = 'code_input';
}

// End game
function endGame(won) {
    if (won) {
        addOutput('');
        addOutput('Sonce ti osvetli obraz.');
        addOutput('Zmagal si');
        addOutput('BRAVOOOOOOOO');
        addOutput('');
        addOutput('Igra je končana. Osveži stran za novo igro.');
    } else {
        addOutput('');
        addOutput('Eksperiment 67-A je neuspešen.');
        addOutput('Sistem se je izključil.');
        addOutput('');
        addOutput('Igra je končana. Osveži stran za novo igro.');
    }
    
    terminalInput.disabled = true;
    gameState.waitingForInput = false;
    gameState.currentInputType = null;
}

// Start game when page loads
document.addEventListener('DOMContentLoaded', function() {
    initGame();
});

