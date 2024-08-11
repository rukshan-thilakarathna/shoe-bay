<footer id="ft">
	<div class="w">
		<span class="s3" id="ys3"><span id="s3"></span>Page Top</span>
		<p id="p0">SukeeFashion CMS Version 1.0</p>
	</div>
<script>
function scrollToTop(k){var t;if(k>0){k-=20;window.scrollTo(0,k);t=setTimeout(function(){scrollToTop(k-=20);},10);}else clearTimeout(t);}
_('ys3').onclick=function(){scrollToTop(document.documentElement.scrollHeight);}
</script>
    <script>
        function myCategoryFunction() {
            var x = document.getElementById("zyca").value;

            // if(x == 1){
            //     document.getElementById('Colour').style.display='block';
            //     document.getElementById('Size').style.display='block';
            // }else{
            //     document.getElementById('Colour').style.display='none';
            //     document.getElementById('Size').style.display='none';
            // }elseif(x == 28){

            //     document.getElementById('Colour').style.display='block';

            // }else{
            //     document.getElementById('Colour').style.display='none';
            // }

            const xhttp = new XMLHttpRequest();
            xhttp.onload = function() {
                // var text = ""; // Initialize the text variable
                var response = this.responseText; // Get the response text
                var lis = document.querySelectorAll('#subzyca');

                lis.forEach(function(element) {
                    // Remove all child elements of the current element
                    while (element.firstChild) {
                        element.removeChild(element.firstChild);
                    }
                });

                const jsonObject = JSON.parse(response)
                var dataLength = jsonObject.length;
                // console.log(jsonObject)
                // console.log(response)
                console.log(dataLength)

                if (dataLength > 0){
                    document.getElementById('subcatfild').style.display='block';

                    document.getElementById('subsubcatfild').style.display='none';
                    for(let i=0; i<dataLength; i++){
                        const option = document.createElement('option');
                        option.value = jsonObject[i]['cid'];
                        option.textContent = jsonObject[i]['cn'];
                        document.getElementById("subzyca").appendChild(option);
                    }
                }else {
                    document.getElementById('subcatfild').style.display='none';
                    document.getElementById('subsubcatfild').style.display='none';
                }
            }
            xhttp.open("GET", "admin/ajaxAddItemCategory.php?mainCategoryId=" + x, true);
            xhttp.send();
        }

        function mySubCategoryFunction() {
            var x = document.getElementById("subzyca").value;

           


            

            const xhttp = new XMLHttpRequest();
            xhttp.onload = function() {
                // var text = ""; // Initialize the text variable
                var response = this.responseText; // Get the response text
                var lis = document.querySelectorAll('#subsubzyca');

                lis.forEach(function(element) {
                    // Remove all child elements of the current element
                    while (element.firstChild) {
                        element.removeChild(element.firstChild);
                    }
                });

                const jsonObject = JSON.parse(response)
                var dataLength = jsonObject.length;
                // console.log(jsonObject)
                // console.log(response)
                console.log(dataLength)

                if (dataLength > 0){
                    document.getElementById('subsubcatfild').style.display='block';
                    for(let i=0; i<dataLength; i++){
                        const option = document.createElement('option');
                        option.value = jsonObject[i]['cid'];
                        option.textContent = jsonObject[i]['cn'];
                        document.getElementById("subsubzyca").appendChild(option);
                    }
                }else {
                    document.getElementById('subsubcatfild').style.display='none';
                }

                // console.log(response)
            }
            xhttp.open("GET", "admin/ajaxAddItemSubCategory.php?mainCategoryId=" + x, true);
            xhttp.send();


        }

        var clickCount = 0;
        function AddRow() {
            clickCount++;
            // Create a new div element to hold your component
            var newDiv = document.createElement('div');
            newDiv.className = 'x3d';
            newDiv.id = 'maindiv'+clickCount;
            newDiv.style.display = 'flex';
            newDiv.style.marginTop = '15px';

            // HTML content for the new row
            var component = `
                <input type="text" class="x3in" name="colour[]" value="" onkeyup="showResult(this.value,${clickCount})" id="color_input_${clickCount}" style="width: 50%;">
                <div style="width: 50%; background: white; border-radius: 5px; margin-left: 7px;" id="color_div_${clickCount}"></div>
                <button onclick="AddRow()" type="button" class="x3in x3in2" style="margin: 0 0 0 6px; width: 165px;">Add New</button>
                <button onclick="removeRow('maindiv${+clickCount}')" type="button" class="x3in x3in2" style="margin: 0 0 0 6px;width: 50px;">X</button>
            `;

            // Set the innerHTML of the new div to your component HTML
            newDiv.innerHTML = component;

            // Append the newDiv to wherever you want to add this new row (e.g., a container)
            // For example, assuming you have a container with id "container":
            var container = document.getElementById('Colour');
            container.appendChild(newDiv);
        }

        function AddRowSize() {
            clickCount++;
            // Create a new div element to hold your component
            var newDiv = document.createElement('div');
            newDiv.className = 'x3d';
            newDiv.id = 'maindivd'+clickCount;
            newDiv.style.display = 'flex';
            newDiv.style.marginTop = '15px';

            // HTML content for the new row
            var component = `
                <input type="text" class="x3in" name="size[]" value="" onkeyup="showResult(this.value,${clickCount})" id="color_input_${clickCount}" style="width: 103%;">
                <button onclick="AddRow()" type="button" class="x3in x3in2" style="margin: 0 0 0 6px; width: 165px;">Add New </button>
                 <button onclick="removeRow('maindivd${+clickCount}')" type="button" class="x3in x3in2" style="margin: 0 0 0 6px;width: 50px;">X</button>
            `;

            // Set the innerHTML of the new div to your component HTML
            newDiv.innerHTML = component;

            // Append the newDiv to wherever you want to add this new row (e.g., a container)
            // For example, assuming you have a container with id "container":
            var container = document.getElementById('Size');
            container.appendChild(newDiv);
        }

        function showResult(val,id){
                document.getElementById('color_div_'+id).style.backgroundColor = val;
           
            
        }
        function removeRow(id){
                document.getElementById(id).remove()
           
            
        }
    </script>
</footer>
</body>
</html>
<?php
/*}catch(PDOException $e){
	//echo $e->getMessage();
	echo "Something is Wrong. Please report to the site admin";
}*/
?>