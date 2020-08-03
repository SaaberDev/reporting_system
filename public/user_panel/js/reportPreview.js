       const reporbutton = document.querySelector("#submitBtn");
       const asset = document.getElementsByName("RadioAsset");
       const weakness = document.getElementsByName("RadioWeakness");
       const otherWeakness = document.getElementsByName("otherWeakness");
       /* cvss */
       const severityStatic = document.getElementById('showResult');
       const severity = document.getElementById('cvssboard');

       const title = document.getElementsByName("title")[0];
       const textType = document.querySelectorAll('textarea');
       const prev_box = document.querySelector('#prev_box');
       const mainForm = document.forms[0];





       class display {
           constructor(asset, weakness, otherWeakness, title, severityStatic, severity, textType) {
               this.asset = asset;
               this.weakness = weakness;
               this.otherWeakness = otherWeakness;
               this.severityStatic = severityStatic;
               this.severity = severity;
               this.title = title;
               this.textType = textType;
           }
           getRadioValue(list) {
               let radionV = "Not Selected";
               //console.log(list);
               list.forEach((value) => {
                   if (value.checked) {
                       radionV = value.value
                   }
               });
               return radionV;
           }
           markdownPreview(target) {
               const converter = new showdown.Converter();
               // console.log(target.value);
               return converter.makeHtml(target.value);

           }
           clearPrev(target) {
               while (target.firstChild) {
                   //console.log(target.firstChild);
                   target.removeChild(target.firstChild);
               }
           }
           textInpPrev(textInp) {
               let fixation = document.createElement('div');
               fixation.classList = 'fixation';
               let fixTitle = document.createElement('h2');
               // console.log(textInp.parentElement.parentElement.previousElementSibling.previousElementSibling.innerText);
               fixTitle.innerHTML = textInp.parentElement.parentElement.previousElementSibling.previousElementSibling.innerText;
               fixation.appendChild(fixTitle);
               let fixationf = document.createElement('div');
               fixationf.classList = 'prev-content';
               let inpValue = this.markdownPreview(textInp);
               fixationf.innerHTML = inpValue;
               fixation.appendChild(fixationf);
               prev_box.appendChild(fixation);
           }
           preview() {
               let weakness = document.querySelector('#prev_weakness');
               // console.log( this.getRadioValue(this.weakness));
               weakness.innerHTML = this.getRadioValue(this.weakness);

               let otherWeakness = document.querySelector('#prev_otherWeakness');
               otherWeakness.innerHTML = document.getElementById('otherWeakness').value;

               let asset = document.querySelector('#prev_asset');
               asset.innerHTML = this.getRadioValue(this.asset);

               /* CVSS Static */
               let severityStatic = document.querySelector('#prev_severityStatic');
               severityStatic.innerHTML = document.getElementById('c.valueStatic').value;
               /* CVSS Calculator */
               let severity = document.querySelector('#prev_severity');
               severity.innerHTML = document.getElementById('c.value').value;


               let title = document.querySelector('#prev_title');
               title.innerHTML = document.getElementById('vul_title').value;

               this.clearPrev(prev_box);
               // console.log(prev_box.firstChild);
              this.textType.forEach((value) => {
                  this.textInpPrev(value);
              });
           }
       }

       reporbutton.addEventListener('click', function() {
           const obj = new display(asset, weakness, title, otherWeakness, severityStatic, severity, textType);
           obj.preview();
       });

       document.getElementById('mainFormSubmit').addEventListener('click', function() {
           mainForm.submit();
       });
