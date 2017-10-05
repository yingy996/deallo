var app = angular.module("moneySaver", []);
app.controller("addProductCtrl", function($scope) {
    //For image upload
    $scope.test = "hi";
    $scope.images = [];
    $scope.imgName = "Click 'Browse' to add photo, multiple photos may be added";
    
    //For preventing form submission when inputs are invalid
    $scope.submitted = false;
    
    //For image upload
    $scope.getImgUrl = function(event) {
        var files = event.target.files;
    
        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            $scope.imgName = file.name;
            var fileReader = new FileReader();
            fileReader.onload = $scope.loadImg;
            fileReader.readAsDataURL(file);
        }
   }
    
    $scope.loadImg = function(e){
        $scope.$apply(function(){
           $scope.images.push(e.target.result); 
        });
    }
    
    //For preventing form submission when inputs are invalid
    $scope.productSubmit = function(e){   
        if($scope.frmProduct.$invalid){
            e.preventDefault();
            $scope.submitted = true;
            $scope.test = "no submit";
        }
    };
    
});