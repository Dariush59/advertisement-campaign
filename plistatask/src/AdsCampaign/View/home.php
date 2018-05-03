<!DOCTYPE html>
<html lang="en">

<head>
    <title>Device Detector</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

</head>

<body data-spy="scroll" data-target="#nav" data-offset="0" style="background-color: mintcream;">
    <main>
        <section class="container-fluid" id="top">
            <div class="container">
                <h3 style="margin:30px 0px 20px 0px; ">Your device info:</h3> 
                <div class="list-group">
                    <div class="list-group-item text-left" style="background-color: azure;">
                        <div class="row list-group-item-light" style="padding: 15px;">
                            <div class="col-sm">Device Type</div>
                            <div class="col-sm"><?php echo $data['detection']['davice']?></div>
                        </div>
                        <div class="row list-group-item-secondary" style="padding: 15px;">
                            <div class="col-sm">Operating System</div>
                            <div class="col-sm"><?php echo $data['detection']['os']?></div>
                        </div>
                        <div class="row list-group-item-light" style="padding: 15px;">
                            <div class="col-sm">Browser</div>
                            <div class="col-sm"><?php echo $data['detection']['browser']?></div>
                        </div>
                        <div class="row list-group-item-secondary" style="padding: 15px;">
                            <div class="col-sm">Mobile Brand <i><small>(Moblie Only)</small></i></div>
                            <div class="col-sm"><?php echo $data['detection']['brand']?></div>
                        </div>
                        <div class="row list-group-item-light" style="padding: 15px;">
                            <div class="col-sm">IP Address</div>
                            <div class="col-sm"><?php echo $data['detection']['ip']?></div>
                        </div>
                        <div class="row list-group-item-secondary" style="padding: 15px;">
                            <div class="col-sm">Organisation</div>
                            <div class="col-sm"><?php echo $data['detection']['organisation']?></div>
                        </div>
                        <div class="row list-group-item-light" style="padding: 15px;">
                            <div class="col-sm">Host Name</div>
                            <div class="col-sm"><?php echo $data['detection']['host_name']?></div>
                        </div>
                        <div class="row list-group-item-secondary" style="padding: 15px;">
                            <div class="col-sm">Location</div>
                            <div class="col-sm"><?php echo $data['detection']['coutry']?></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>

</html>