<div class="preloader show">
   <div class="preloader_logo">
      <div class="logo">
         <div>ARU SAGI</div>
         <div>coach & trainer</div>
      </div>
   </div>
	<div class="preloader_inner">0%</div>
</div>

<script>
   loader();
   function loader(_success) {
      var obj = document.querySelector('.preloader')
      inner = document.querySelector('.preloader_inner')
      var w = 0
      t = setInterval(function() {
         w = w + 1;
         inner.textContent = w+'%';
         if (w === 100){
            obj.classList.remove('show');
            clearInterval(t);
            w = 0;
            if (_success){return _success()}
         }
      }, 5);
   }
</script>