// Clickable div for index page
	$(document).ready(function(){
		$('.clickable').click(function(){
			window.location = $(this).find("a").attr("href");
		})
	})

// For Form Submit Page

	/* Asset and Weakness Selector */
    $(document).ready(function () {
        $('#clear1').hide();
        $('#clear2').hide();
    });

    /* Asset */
    $(function () {
        const radios = document.getElementsByName('RadioAsset');
        // console.log(radios);
        for(let i = 0 ; i < radios.length ; i++){
            radios[i].onclick = function(){
                document.getElementById('choiceLabel1').innerText = this.value;
                document.getElementById('RadioAssetValue').value = this.value;
                $('#clear1').show();
            };
        }

        $("#clear1").click(function(){
            $('input[name=RadioAsset]').prop('checked' , false);
            $('#clear1').hide();
            document.getElementById('choiceLabel1').innerText = '';
            document.getElementById('RadioAssetValue').value = '';
        });
    });

    /* Weakness */
    $(function () {
        const radio = document.getElementsByName('RadioWeakness');
        // console.log(radio);
        for(let i = 0; i < radio.length; i++){
            radio[i].onclick = function(){
                document.getElementById('choiceLabel2').innerText = this.value;
                document.getElementById('RadioWeaknessValue').value = this.value;
                $('#clear2').show();
            };
        }
        $('#clear2').click(function() {
            $('input[name=RadioWeakness]').prop('checked', false);
            $('#clear2').hide();
            document.getElementById('choiceLabel2').innerText = '';
            document.getElementById('RadioWeaknessValue').value = '';
        });
    });


    /**
     * List Search
     */
    /* For Asset */
    $(document).ready(function(){
        $("#assetSearchInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#assetList label").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });

        /* For Weakness */
        $("#weaknessSearchInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#weaknessList label").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });

    /*
    * CVSS Calculator Custom JS
    * */
    //Toggle to get and remove CVSS result value
    $(document).ready(function () {
        $('#cvssboard').hide();
        $('#toggleCvss').click(function () {
            $('#cvssboard').toggle(600, function () {
                document.getElementById('c.value').value = '';
                document.getElementById('c.valueStatic').value = '';
                document.getElementById('showResult').innerText = '';
                $("#showResult").removeAttr("style", " background: #00C391 !important; color: #000 ; display: inline-flex;");
            });
        });
    });

    // CVS Top score bar result
    $(function () {
        const cv = document.getElementsByName('cv');
        // console.log(radios);
        for(let i = 0 ; i < cv.length; i++){
            cv[i].onclick = function(){
                document.getElementById('showResult').innerText = this.value;
                document.getElementById('c.valueStatic').value = this.value;
                $("#showResult").attr("style", " background: #00C391 !important; color: #000 ; display: inline-flex;");
            };
            //$('input[name=cv]').prop('checked', false);
        }
    });
    // CVSS SCORE CALCULATOR JS
    const c = new CVSS("cvssboard", {
        onchange: function () {
            //window.location.hash = c.get().vector;
            c.vector.setAttribute('href', '#' + c.get().vector)
            document.getElementById('c.value').value = c.get().severity;
        }
    });
    /*if (window.location.hash.substring(1).length > 0) {
        c.set(decodeURIComponent(window.location.hash.substring(1)));
    }*/

