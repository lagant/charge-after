define(function() {
    let loaded = false;
    return function ({cdnUrl, caConfig}){
        if(loaded) return;
        loaded = true;
        !function(e,t,c,a,n){var r,o=t.getElementsByTagName(c)[0];
         e.ChargeAfter || (e.ChargeAfter = {}),
         t.getElementById(a)||(e.ChargeAfter.cfg = n,(r=t.createElement(c)).id=a,
             r.src=cdnUrl+"/promotional-widget/v1/widget.min.js?t="+1*new Date,
             r.async=!0,o.parentNode.insertBefore(r,o))}
        (window,document,"script","chargeafter-promotional-widget",caConfig);
    }
})
