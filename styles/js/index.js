$(document).ready(function(){
    $.ajax({
        url: "/controller/login.php",
        data: { checklogin: true },
        type: "POST",
        success: function(response){
            response = JSON.parse(response);            
            if(response.success){
                window.location.href = "/pregled";
            }
        }
    });

    var code = []; // Array to store entered digits
    var currentSelectedNumber = null; // Track which number is currently selected on dial
    
    // Handle clicking on numbers
    $('.safe-number').on('click', function(){
        if(code.length >= 4) return; // Don't add if already 4 digits
        
        var number = $(this).data('number');
        code.push(number.toString());
        
        // Update display
        updateDisplay();
        
        // Rotate dial to show selected number
        rotateDialToNumber(number);
        
        // Auto-submit when 4 digits are entered
        if(code.length === 4){
            setTimeout(function(){
                submitCode();
            }, 300);
        }
    });
    
    // Update the code display
    function updateDisplay(){
        for(var i = 0; i < 4; i++){
            if(i < code.length){
                $('#code-digit-' + (i + 1)).text(code[i]).addClass('filled');
            } else {
                $('#code-digit-' + (i + 1)).text('-').removeClass('filled');
            }
        }
        $("#kodazavstop").val(code.join(''));
    }
    
    // Rotate dial to show selected number
    function rotateDialToNumber(number){
        currentSelectedNumber = number;
        var rotation = getRotationForNumber(number);
        $('.light').css({
            'transform': 'rotate(' + rotation + 'deg)',
            'transition': 'transform 0.5s ease'
        });
        $('.dot').css({
            'transform': 'rotate(' + rotation + 'deg)',
            'transition': 'transform 0.5s ease'
        }).addClass('active');
        $('.dot span').css({
            'transform': 'rotate(' + (-rotation) + 'deg)',
            'transition': 'transform 0.5s ease',
            'opacity': '0.9'
        });
    }
    
    // Get rotation angle for each number (0-9)
    function getRotationForNumber(number){
        var rotations = {
            0: -90,
            1: -54,
            2: -18,
            3: 18,
            4: 54,
            5: 90,
            6: 126,
            7: 162,
            8: 198,
            9: 234
        };
        return rotations[number] || -90;
    }
    
    // Submit the code
    function submitCode(){
        var kodazavstop = code.join('');
        
        if(kodazavstop.length !== 4){
            // Shake animation
            $(".safe-container").addClass("shake");
            setTimeout(function(){
                $(".safe-container").removeClass("shake");
            }, 500);
            return;
        }
        
        $.ajax({
            url: "/controller/login.php",
            type: "POST",
            data: { kodazavstop: kodazavstop },
            success: function(response){
                response = JSON.parse(response);
                console.log(response.success);
                if(response.success){
                    window.location.href = "/pregled";
                } else {
                    // Clear code and reset display
                    code = [];
                    updateDisplay();
                    rotateDialToNumber(0);
                    $(".safe-container").addClass("shake");
                    setTimeout(function(){
                        $(".safe-container").removeClass("shake");
                    }, 500);
                    alert("Koda za zavstop ni pravilna");
                }
            },
            error: function(xhr, status, error){
                alert("Prišlo je do napake: " + error);
            }
        });
    }
    
    // Initialize display
    updateDisplay();
    rotateDialToNumber(0);
});
