<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
<script language="javascript" type="text/javascript">
    SKayu = document.querySelector('input[name="MCSKayu"]');
    Hickory = document.querySelector('input[name="MCHickory"]');
    CaCO3 = document.querySelector('input[name="MCCaCO3"]');
    Pollard = document.querySelector('input[name="MCPollard"]');
    Tapioka = document.querySelector('input[name="MCTapioka"]');
    WeightperBag = document.querySelector('input[name="WeightperBag"]');
    TotalBags = document.querySelector('input[name="TotalBags"]');
    Calculate = document.getElementById("Calculate");

    Calculate.addEventListener('click', function(){
        W = WeightperBag.value;
        T = TotalBags.value;
        x = 0.35 * W;
        WCaCO3 = x * 0.03 / (100 - CaCO3.value) / 10;
        WSKayu = x * 0.67 / (100 - SKayu.value) / 10;
        WPollard = x * 0.20 / (100 - Pollard.value) / 10;
        WTapioka = x * 0.10 / (100 - Tapioka.value) / 10;
        TotalW =  WCaCO3 + WSKayu + WPollard + WTapioka;
        TotalD = (x * 0.03 + x * 0.67 + x * 0.20 + x * 0.10)/1000;
        WAir = (0.65 * W)/1000 - (TotalW - (x/1000));
        document.querySelector('input[name="Tapioka"]').value = (WTapioka * T).toFixed(3);
        document.querySelector('input[name="Pollard"]').value = (WPollard * T).toFixed(3);
        document.querySelector('input[name="CaCO3"]').value = (WCaCO3  * T).toFixed(3);
        document.querySelector('input[name="SKayu"]').value = (WSKayu  * T).toFixed(3);
        document.querySelector('input[name="Air"]').value = (WAir * T).toFixed(3);
    });

</script>