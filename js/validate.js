 $().ready(function(){
            $("#form").validate({
                rules: {
                    first: {
                        required: true,
                        minlength: 3
                    },
                    last:{
                        required:true,
                        minlength: 3
                    },
                    num:{
                        required:true,
                        minlength: 10
                    },
                    alt:{
                        minlength: 10
                    },
                    email:{
                        required:true,
                        email:true
                    },
					address:{
						required:true,
						minlength:6
					},
					pincode:{
						required:true,
						minlength:6,
						maxlength:6
					},
					state:{
						required:true
					}
					city:{
						required:true
					}
                    
                },
                messages:{
                    first: "Please enter your firstname",
                    last:"Please enter your lastname",
                    num:"please enter contact number"
					
                }
            })
        });