// CVS Top score bar result
    $(function () {
    	const cv = document.getElementsByName('cv');
    	// console.log(cv);
    	for(let i = 0 ; i < cv.length ; i++){
    		cv[i].onclick = function(){
    			document.getElementById('showResult').innerText = this.value;
    			$("#showResult").attr("style", " background: #00C391 !important; color: #000 ; display: inline-flex;");
    		};
    	};
    });
// CVSS SCORE CALCULATOR JS
	var c = new CVSS("cvssboard", {
    onchange: function() {
        window.location.hash = c.get().vector;
        c.vector.setAttribute('href', '#' + c.get().vector);
    }
    });
    if (window.location.hash.substring(1).length > 0) {
        c.set(decodeURIComponent(window.location.hash.substring(1)));
    }

// CVSS End
