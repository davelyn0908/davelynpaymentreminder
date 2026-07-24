<?php
$user = $_GET['user']?? 'unknown';
$csv_url = "https://docs.google.com/spreadsheets/d/1fqJXZJ6FAZPqcReFvGugADeQXh-KUsPen90na8eTu7I/gviz/tq?tqx=out:csv";
$csv = @array_map('str_getcsv', @file($csv_url));
if($csv){
    $header = array_shift($csv);
    $data = ["name"=>$user, "amount"=>"500", "plan"=>"Unknown"];
    foreach($csv as $row){
        if(strtolower(trim($row[0])) == strtolower(trim($user))){
            $data = ["name"=>$row[1], "amount"=>$row[2], "plan"=>$row[3]];
            break;
        }
    }
} else {
    $data = ["name"=>$user, "amount"=>"500", "plan"=>"Error loading data"];
}
?>
<!DOCTYPE html>
<html>
<head><title>Payment Due</title>
<style>body{font-family:Arial; background:#e6f7ff; display:flex; justify-content:center; align-items:center; min-height:100vh; margin:0; padding:20px;}.box{background:#fff; padding:30px; border-radius:10px; text-align:center; box-shadow:0 4px 15px rgba(0,0,0,0.1); max-width:420px; width:100%; border-top:5px solid #d32f2f;} h1{color:#d32f2f;}.amount{font-size:2.2em; color:#d32f2f; font-weight:bold;}.btn{background:#25D366; color:white; padding:14px 25px; border-radius:8px; text-decoration:none; font-weight:bold; display:inline-block; margin-top:15px;}</style>
</head>
<body>
<div class="box">
<h1>⚠️ INTERNET PAUSED</h1>
<p>Hi <b><?= htmlspecialchars($data['name'])?></b></p>
<div style="background:#f5f5f5; padding:15px; border-radius:8px; margin:15px 0;">Account: <b><?= htmlspecialchars($user)?></b><br>Plan: <b><?= htmlspecialchars($data['plan'])?></b></div>
<p>Amount Due:</p>
<p class="amount">Php <?= htmlspecialchars($data['amount'])?></p>
<h3>Pay via GCash</h3>
<span><b>Account Name:</b> Dave Malinao</span><br>
<span><b>Number:</b> 0955-439-9280</span><br>
<a href="https://m.me/dave.malinao?text=Payment%20Proof%20for%20<?= urlencode($user)?>%20Amount:%20<?= urlencode($data['amount'])?>" class="btn" target="_blank">SEND PROOF OF PAYMENT</a>
</div>
</body>
</html>