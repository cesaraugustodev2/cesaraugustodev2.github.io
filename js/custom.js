// Animations initialization
        new WOW().init();
     
   
        //Efeito no card na home
        $("#webdesign").mouseover(function() {
            $("#webdesign").addClass('border border-primary');
        });
        $("#webdesign").mouseout(function() {
            $("#webdesign").removeClass('border border-primary');
        });

        $("#code").mouseover(function() {
            $("#code").addClass('border border-primary');
        });
        $("#code").mouseout(function() {
            $("#code").removeClass('border border-primary');
        });
        $("#hospedagem").mouseover(function() {
            $("#hospedagem").addClass('border border-primary');
        });
        $("#hospedagem").mouseout(function() {
            $("#hospedagem").removeClass('border border-primary');
        });
        //Efeito nos cards da pagina serviços
       
        $("#site").mouseover(function() {
            $("#site").addClass('border border-primary');
        });
        $("#site").mouseout(function() {
            $("#site").removeClass('border border-primary');
        });
        $("#site").mouseover(function() {
            $("#site").addClass('border border-primary');
        });
        $("#loja").mouseover(function() {
            $("#loja").addClass('border border-primary');
        });
        $("#loja").mouseout(function() {
            $("#loja").removeClass('border border-primary');
        });
        $("#blog").mouseover(function() {
            $("#blog").addClass('border border-primary');
        });
        $("#blog").mouseout(function() {
            $("#blog").removeClass('border border-primary');
        });
        $("#lms").mouseover(function() {
            $("#lms").addClass('border border-primary');
        });
        $("#lms").mouseout(function() {
            $("#lms").removeClass('border border-primary');
        });
        $("#suporte").mouseover(function() {
            $("#suporte").addClass('border border-primary');
        });
        $("#suporte").mouseout(function() {
            $("#suporte").removeClass('border border-primary');
        });



      
        //Efeito Scroll
        $(document).on('click', 'a[href^="#"]', function(event) {
            event.preventDefault();

            $('html, body').animate({
                scrollTop: $($.attr(this, 'href')).offset().top
            }, 1000);
        });
       