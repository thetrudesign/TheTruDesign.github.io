<?php
	require_once('dbconnection.php');
       mysqli_select_db($conn, $dbname);
       $query_Categories = "SELECT Category_ID, Category_Name FROM Categories ORDER BY Category_Name";
       $Categories = mysqli_query($conn, $query_Categories) or die(mysqli_error());
       $row_Category = mysqli_fetch_assoc($Categories);
?>


    <!DOCTYPE HTML>
    <html>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Tru Dinh Week 4 A2</title>
        <!--Jquery 3.2.1 --->
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <!--Jquery 3.2.1 --->
        <!--bootstrap 4.0-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <!--bootstrap 4.0-->
        <script>
            var debugging = false;
            $(document).ready(function() {
                $results = $('#results');
                $categories = $('#categories');
                $products = $('#products');
                $loading = $('#loading'); //loading span
                $products.prop('disabled', true);

                $loading.hide();
                $(document).ajaxError(function(e, jqxhr, settings, errorThrown) {
                    $results.html('Error occurred. The error returned was <em>' + errorThrown + '</em>');
                });

                $(document).ajaxStart(function() {
                    timer = setTimeout(showLoading, 1000);
                });

                function showLoading() {
                    $loading.show();
                }

                $(document).ajaxComplete(function() {
                    $loading.hide();
                    clearTimeout(timer);
                });
                $categories.change(function() {
                    $products.find('option')
                        .remove()
                        .end()
                        .append('<option value="">Please choose</option>')
                        .prop('disabled', true);
                    if ($(this).val() > 0) {
                        $.ajax({
                            type: 'POST',
                            url: 'process.php',
                            dataType: 'JSON',
                            data: {
                                'category_id': $(this).val(),
                                'debugging': debugging
                            },
                            success: function(data) {
                                if (data.result == 'true') {
                                    if (data.count > 0) {
                                        $.each(data.products, function() {
                                            $products.append('<option value="' + this.Product_ID + '">' + this.Product_Name + '</option>');
                                        });

                                        $products.prop('disabled', false);
                                    } else {

                                    }
                                } else {
                                    $results.html('Sorry, an error occurred with your request: ' + data.message);
                                }
                            } //end success()
                        }); //end ajax
                    } //end if($(this).val() > 0)
                }); //end change()

            }); //end document.ready()
        </script>
    </head>

    <body>

        <div class="container">
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-6 mt-5">
                    <h2 class="text-uppercase">Cascading Drop Down List</h2>

                    <hr/>
                    <div class="alert alert-primary">
                        <p>Choose a category in the first drop down list to populate the second with a list of the products that belong to that category.</p>
                        <div class="input-group mb-3">
                            <select id="categories" class="custom-select">
                   <option value="">Choose category</option>
<?php
       do {
              echo "<option value='{$row_Category['Category_ID']}'> {$row_Category['Category_Name']}</option>";
       } while ($row_Category = mysqli_fetch_assoc($Categories));
?>
    </select>
                            <br/><br/>
                            <select id="products" class="custom-select">
                   <option value="">Select Products</option>
    </select>
                            <span id="loading">
                   <i class="fa fa-circle-o-notch fa-spin" style="font-size:24px"> </i>   Loading products, please wait...
    </span>
                            <div id="results">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3"></div>
                </div>
            </div>
        </div>
    </body>

    </html>

    <?php
       mysqli_free_result($Categories);
?>