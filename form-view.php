<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
    <title>Order food & drinks</title>
</head>

<body>
    <div class="container">
        <h1>Order food in restaurant "the Personal Ham Processors"</h1>
        <nav>
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link active" href="?food=1">Order food</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?food=0">Order drinks</a>
                </li>

            </ul>
        </nav>
        <form method="post">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="email">E-mail:</label>
                    <input type="text" id="email" name="email" class="form-control" value="<?php if (isset($_SESSION['email'])) {
                                                                                                echo $_SESSION['email'];
                                                                                            } ?>">
                    <span><?php echo $emailErr; ?></span>
                </div>
                <div></div>
            </div>

            <fieldset>
                <legend>Address</legend>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="street">Street:</label>
                        <input type="text" name="street" id="street" class="form-control" value="<?php if (isset($_SESSION['street'])) {
                                                                                                        echo $_SESSION['street'];
                                                                                                    } ?>">
                        <!-- added value if there is value saved then echo -->
                        <span><?php echo $streetErr; ?></span>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="streetnumber">Street number:</label>
                        <input type="text" id="streetnumber" name="streetnumber" class="form-control" value="<?php if (isset($_SESSION['streetnumber'])) {
                                                                                                                    echo $_SESSION['streetnumber'];
                                                                                                                } ?>">
                        <span><?php echo $streetNumberErr; ?></span>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="city">City:</label>
                        <input type="text" id="city" name="city" class="form-control" value="<?php if (isset($_SESSION['city'])) {
                                                                                                    echo $_SESSION['city'];
                                                                                                } ?>">
                        <span><?php echo $cityErr; ?></span>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="zipcode">Zipcode</label>
                        <input type="text" id="zipcode" name="zipcode" class="form-control" value="<?php if (isset($_SESSION['zipcode'])) {
                                                                                                        echo $_SESSION['zipcode'];
                                                                                                    } ?>">
                        <span><?php echo $zipCodeErr; ?></span>
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <legend>Products</legend>
                <?php foreach ($products as $i => $product) : ?>
                    <label>
                        <input type="checkbox" value="1" name="products[<?php echo $i ?>]" /> <?php echo $product['name'] ?> -
                        &euro; <?php echo number_format($product['price'], 2) ?></label><br />
                <?php endforeach; ?>
            </fieldset>

            <label>
                <input type="checkbox" name="express_delivery" value="5" />
                Express delivery (+ 5 EUR)
            </label>

            <button type="submit" class="btn btn-primary" name="button">Order!</button>
            <button type="submit" class="btn btn-primary" name="restart">Restart</button>
            <button type="submit" class="btn btn-primary" name="done">Done</button>
        </form>

        <footer>You already ordered <strong>&euro; <?php if (isset($_SESSION['totalCost'])) {
                                                        echo $_SESSION['totalCost'];
                                                    } ?></strong> in food and drinks.</footer>
        <span><?php echo $send; ?></span>
    </div>

    <style>
        footer {
            text-align: center;
        }
    </style>
</body>

</html>