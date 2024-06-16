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