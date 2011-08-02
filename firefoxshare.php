<html>
 <script src="https://myapps.mozillalabs.com/jsapi/include.js"></script>
 <script src="https://myapps.mozillalabs.com/jsapi/jschannel.js"></script>
 <script>

var chan = Channel.build({
  window: window.parent,
  origin: "*",
  scope: "openwebapps_conduit"
});
chan.bind("link.send", function (trans, s) {
  trans.delayReturn(true);
  if (s) {
    console.log('send link', s);
    // Post the link in s
  }
  trans.complete()  
});
   
 </script>
</html>
