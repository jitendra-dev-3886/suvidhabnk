$(document).ready(function(){
       var room_no = 1;
   
   $("#addrmbtn").click(function(){
      
      room_no++;
      
      if(room_no == 6){
           $("#addrmbtn").hide();
       }
       
      $("#guestromminfo").append(`<div class="col-md-12" id="guestdealisdiv">
						<input type="hidden" id="roomno" value="${room_no}">
							<h4 class="my-3" id="roomname">Room ${room_no}</h4>
							<div class="guestadroommen">
								<p>Adults : </p>
								<div class="adultsno guestno">
									<button class="adldecbtn">-</button>
									<input type="number" class="form-control adultsno" id="adultsno${room_no}" readonly onkeypress="return this.value < 8" value="1">
									<button class="adlincbtn">+</button>
								</div>
							</div>
							<div class="guestadroommen">
								<p>Children : </p>
								<div class="adultsno guestno">
									<button class="chlddecbtn">-</button>
									<input type="number" class="form-control childno" id="childno${room_no}" readonly onkeypress="return this.value < 2" value="0">
									<button class="chldincbtn">+</button>
								</div>
							</div>
							<div class="row" id="addchildagebox">
							</div>
							<h5 class="text-primary removeroombtn" id="remrmbtn">Remove room</h5> 
							</div>`); 
       
   });
   
   
   $(document).on("click","#remrmbtn",function(){
      $(this).parent().remove();
      room_no--;
      if(room_no < 6){
           $("#addrmbtn").show();
       }
      
   });
   
   
   $(".adlincbtn,.chldincbtn").on("click",function(){
      var praelement = $(this).siblings()[1].className;
      console.log($('#adultsno1').val());
     
   });
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
    
});