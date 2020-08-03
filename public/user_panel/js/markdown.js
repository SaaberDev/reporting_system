// Write & Preview  Button EventListener
    //variables

    let editable,show;

    const targetClasses = document.querySelector('.submit-part');

    //eventListener
    loadEventListener();

    function loadEventListener(){
        targetClasses.addEventListener('click',domChanger);
        targetClasses.addEventListener('keyup',domMarkdown);
        document.addEventListener('DOMContentLoaded',autoMarkdown);
    }

    //functions
    function domChanger(event){

        const target = event.target;
        if (target.classList.contains('write') || target.classList.contains('preview')){
            operation(target);
        }
        //console.log(target,targetClasses);
       // event.preventDefault();
    }

    function operation(target){
        const parent = target.parentElement.parentElement;
        editable = parent.querySelector('.TextEditorArea-field');
        show = parent.querySelector('.TextEditorArea-preview');
        if (target.classList.contains('write')){
            domToggle();
        }else{
            domToggle(false);
        }
        //console.log();
    }

    function domToggle(write=true){
        if (write){
            //console.log('edit');
            editable.style.display = "block";
            show.style.display = "none";
            //console.log(editable);
        }else{
            show.style.display = "block";
            editable.style.display = "none";  
        }  
    }

    function domMarkdown(event){

       const target = event.target;
      
       if(target.classList.contains('TextEditorArea-field')){
       show = target.nextElementSibling;
      // console.log();
       markdownPreview(target);
       }
    }

    function markdownPreview(target){
        const   converter = new showdown.Converter();
       // console.log(target.value);
        const html = converter.makeHtml(target.value);
        show.innerHTML = html;
    }

    function autoMarkdown(){
       // console.log('autoload');
        const markDownClasses = document.getElementsByClassName('TextEditorArea-field');
        //console.log(markDownClasses);
        for (let classs of markDownClasses) {
            
            show = classs.nextElementSibling;
           //; console.log()
            markdownPreview(classs);
        }
    }

   

// Mark-Down Code Changer

const   textEditor = document.querySelector('.TextEditorArea-field');

const   converter = new showdown.Converter();

