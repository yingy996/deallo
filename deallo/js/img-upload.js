var app = angular.module("moneySaver", []);
app.controller("imgUploadCtrl", function($scope) {
    $scope.test = "hi";
    $scope.images = [];
    $scope.imgName = "Click 'Browse' to add photo, multiple photos may be added";
    
    $scope.getImgUrl = function(event) {
        var files = event.target.files;
    
        for (var i = 0; i < files.length; i++){
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
    
                                             
});