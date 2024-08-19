<form action="#" method="post" enctype="multipart/form-data">
<div class="col-sm-12 col-md-4 col-lg-4">
<div class="form-group col-md-6">
                    <label style="margin-top: -30px;">plate</label>
                   
                    <input type="text" name="plate">
                </div>
                <div class="form-group col-md-6">
                    <label style="margin-top: -30px;">Cover_photo</label>
                    <img src="" style="display: none; height: 250px; width: 300px;" id="coverPic"><br>
                    <input type="file" name="image[]" multiple onchange="showImage.call(this)" id="file">
                </div>
                <button type="submit" class="btn btn-primary" name="submit">Register</button>
            </div>
</form>

<script>
    function showImage() {
        var fileinput = document.getElementById("file");
        var filepath = fileinput.value;
        var allowedext = /(\.jpeg|\.jpg|\.png)$/i;

        if (!allowedext.exec(filepath)) {
            alert("please choose an image");
            fileinput.value = '';
            return false;
        } else {
            if (this.files && this.files[0]) {
                var obj = new FileReader();
                obj.onload = function(data) {
                    var image = document.getElementById("coverPic");
                    image.src = data.target.result;
                    image.style.display = "block";
                }
                obj.readAsDataURL(this.files[0]);
            }
        }
    }
</script>
<?php
 
if(isset($_POST["submit"])){
    $plate=$_POST["plate"];
    mkdir("..\images\ $plate",0777,true);  
    $vdir="..\images\ $plate\ ";
$imgtmp= $_FILES['image']['tmp_name'];
foreach($_FILES['image']['name'] as $key=>$val)
 {
    echo $fileName = basename($_FILES['image']['name'][$key]);
    move_uploaded_file($imgtmp[$key], $vdir.$fileName);
}

}
?>