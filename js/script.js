    function showNarbav() {
      var x = document.getElementById("myTopnav");
      if (x.className === "topnav") {
        x.className += " responsive";
      } else {
        x.className = "topnav";
      }
    }
    function Redirect(input) {
        if (input.length==0) {
          return;
        }
        else{
        window.location=("search_page.php?input="+input);
        }      
    }

    function timkiem(str1,str2,str3,str4) {
      if (str1.length==0) {
          document.getElementById("ketquatk").innerHTML="Hãy nhập gì đó !";
          return;
      }
      var xmlhttp=new XMLHttpRequest();
      xmlhttp.onreadystatechange=function() {
          if (this.readyState==4 && this.status==200) {
                document.getElementById("ketquatk").innerHTML=this.responseText;      
          }
      }
      xmlhttp.open("GET","php/search.php?kqtk="+str1+"&Lop="+str2+"&Bo="+str3+"&Ho="+str4,true);
      xmlhttp.send();
      }

      function previewImages() {
        var preview = document.querySelector('#preview');        
        if (this.files) {
          [].forEach.call(this.files, readAndPreview);
        }      
      function readAndPreview(file) {      
          // Make sure `file.name` matches our extensions criteria
          if (!/\.(jpe?g|png|gif)$/i.test(file.name)) {
            return alert(file.name + " is not an image");
          } // else...          
          var reader = new FileReader();
          
          reader.addEventListener("load", function() {
            var image = new Image();
            image.height = 100;
            image.title  = file.name;
            image.src    = this.result;
            preview.appendChild(image);
          });
          
          reader.readAsDataURL(file);
          
        }
      
      }
      
      document.querySelector('#file-input').addEventListener("change", previewImages);

      function readMore() {
        var moreText = document.getElementById("more");
        var btnText = document.getElementById("read-more");

        if (moreText.style.display === "none") {
          moreText.style.display = "block";
          btnText.innerHTML = "Ẩn đi"; 

        } else {
          moreText.style.display = "none";
          btnText.innerHTML = "Xem thêm"; 
        }
      }

