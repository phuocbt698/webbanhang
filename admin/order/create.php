<?php
    include_once('../layout/header.php');
    include_once('../layout/sidebar.php');
?>
 <div class="table-data">
                    <div class="header-table">
                        <h3>Form data</h3>
                        <a href="" class="a-icon">
                            <div class="icon">
                                <i class="fas fa-list"></i>
                                Danh sach data
                            </div>
                        </a>
                    </div>
                    <div class="form-data">
                        <form action="" class="create-data">
                            <div class="input-data">
                                <label for="">Text input</label>
                                <input type="text" name="" id="" class="input-text">
                            </div>
                            <div class="input-data">
                                <label for="">File</label>
                                <input type="file" name="" id="" class="input-file">
                            </div>
                            <div class="preview">

                            </div>
                            <div class="input-data">
                                <label for="">Textarea</label>
                                <textarea name="textarea" id="" cols="30" rows="10"></textarea>
                            </div>
                            <div class="input-data">
                                <label for="">Text input</label>
                                <div class="radio-data">
                                    <input type="radio" name="" id="">
                                    <label for="">aaa</label>
                                    <input type="radio" name="" id="">
                                    <label for="">bbb</label>
                                </div>
                            </div>
                            <div class="input-data">
                                <label for="">Text input</label>
                                <select name="" id="">
                                    <option value="">1</option>
                                    <option value="">1</option>
                                    <option value="">1</option>
                                </select>
                            </div>
                            <div class="submit-form">
                                <button type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
                
                <script>
                    CKEDITOR.replace( 'textarea' );
                </script>
                <script>
    $(document).ready(function(){
        $('.input-file').change(function(e){
            const resultElement = document.querySelector('.preview')
            const files = e.target.files;
            const file = files[0];
            const fileType = file['type'];
            const fileReader = new FileReader();
            fileReader.readAsDataURL(file);
            fileReader.onload = function() {
                const url = fileReader.result;
                resultElement.insertAdjacentHTML(
                    'beforeend',
                    `<img src="${url}" alt="${file.name}" class="img-preview"/>`
                )
            }
        });
    });
  </script>
<?php
    include_once('../layout/footer.php');
?>