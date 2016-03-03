<script type="javascript">
$('#button').click(function() {
    var val1 = $('#text1').val();
   var val2 = $('#text2').val();
   $.ajax({
      type: 'POST',
      url: 'test2.php',
      data: { text1: val1, text2: val2 },
      success: function(response) {
         $('#result').html(response);
      }
   });
});
</script>
<body>
<input type="text" id="text1"> +
<input type="text" id="text2">
<button id="button"> = </button>
<div id="result"></div>
</body>