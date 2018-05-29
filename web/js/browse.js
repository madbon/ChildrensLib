var app = angular.module('browseApp', []);

app.factory('redirectToDescription', function () {
    return {
        whenClick: function (object, path) {
          //TODO: Redirect logic
           var id = object.children().eq(0).val();
            window.location = "/childrenslibrarywithyii/web/index.php/browsebook/bookdescription?id=" + id;
        }
    }
});

app.factory('getBookCover', function () {
    return {
        paginate: function ($http, offset, $scope, model) {
                    var url = "/childrenslibrarywithyii/web/index.php/browsebook/paginatebook" + "?offset=" + offset;
                    $http({
                        url: url,
                        method: "GET",
                        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                    }).then(function successCallback(response) {
                        if( response.data.length != 0 ) {
                            angular.forEach(response.data, function (value, key) {
                               $scope.bookcovers.push(model.bookcover(value.id, value.image, value.title, value.author, value.colorTag, value.categoryTag));
                            })
                        } else {
                          $scope.showLoading = false;
                          $scope.enableScroll = false;
                        }
                    }, function errorCallback(response) {
                        console.log(response.statusTex);
                    });
                },

        search: function($http, input, $scope, model) {
          var url = "/childrenslibrarywithyii/web/index.php/browsebook/searchbytitle" + "?search=" + input;
          $http({
                        url: url,
                        method: "GET",
                        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                    }).then(function successCallback(response) {
                      if( response.data.length != 0 ) {
                        var temp = [];
                         angular.forEach(response.data, function (value, key) {
                           temp.push(model.bookcover(value.id, value.image, value.title, value.author, value.colorTag, value.categoryTag));
                         });

                         $scope.bookcovers = temp;
                         $scope.showLoading = false;
                         $scope.enableScroll = false;
                      }
                    }, function errorCallback(response) {
                        console.log(response.statusTex);
                    });

        },

          filter: function($http, $scope, model, id, isImage) {
                var url = (isImage) ? "/childrenslibrarywithyii/web/index.php/browsebook/queryfilterbycategory" : "/childrenslibrarywithyii/web/index.php/browsebook/queryfilterbycolor";
                url = url + "?id=" + id;
                if($scope.filters.length == 1) {
                  $http({
                        url: url,
                        method: "GET",
                        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                    }).then(function successCallback(response) {
                      if( response.data.length != 0 ) {
                        var tempArray = [];
                         angular.forEach(response.data, function (value, key) {
                               tempArray.push(model.bookcover(value.id, value.image, value.title, value.author, value.colorTag, value.categoryTag));
                            })
                         $scope.bookcovers = tempArray;
                      } else {
                        $scope.bookcovers = [];
                      }
                    }, function errorCallback(response) {
                        console.log(response.statusTex);
                    });
                } else {
                    var tempArray = [];
                    angular.forEach($scope.bookcovers, function (value, key) {
                      var splitedValue;
                      if(isImage) {
                        splitedValue = value.category.split(",");
                      } else {
                        splitedValue = value.color.split(",")
                      }
                      angular.forEach(splitedValue, function (splited, key) {
                          if(splited == id) {
                              tempArray.push(model.bookcover(value.id, value.image, value.title, value.author, value.color, value.category));
                          } 
                      });
                      $scope.bookcovers = tempArray;
                    });

                }
            },

            remove: function ($http, $scope, model, url) {
                $http({
                        url: url,
                        method: "GET",
                        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                    }).then(function successCallback(response) {
                      if( response.data.length != 0 ) {
                        var tempArray = [];
                         angular.forEach(response.data, function (value, key) {
                               tempArray.push(model.bookcover(value.id, value.image, value.title, value.author, value.colorTag, value.categoryTag));
                            });
                         $scope.bookcovers = tempArray;
                      } else {
                        $scope.bookcovers = [];
                      }
                    }, function errorCallback(response) {
                        console.log(response.statusTex);
                    });
            },

            getSubCategories: function($http, $scope, model, url, $timeout, callback) {
              $scope.showLoader = true;
              $http({
                        url: url,
                        method: "GET",
                        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                    }).then(function successCallback(response) {
                      if( response.data.length != 0 ) {
                          var tempArray = [];
                          angular.forEach(response.data, function(value, key) {
                              var imageOrColor = value.image == null ? value.value : value.image;
                              var isImage = value.image == null ? false : true;
                              tempArray.push(model.subcategory(value.id, value.name, imageOrColor, isImage));
                          });


                          $scope.forPagination = tempArray;
                          var lastIndex = $scope.forPagination.length > $scope.maximum ? $scope.maximum : $scope.forPagination.length;
                          $scope.showNext = $scope.forPagination.length > $scope.maximum ? true : false;
                          $scope.subcategories = $scope.forPagination.slice(0, lastIndex);
                          $scope.lastIndexPaginate = lastIndex;
                          $scope.firstIndexPaginate = 0;
                          $scope.paginateCount = $scope.subcategories.length;
                      }

                      $timeout(function(){
                        $scope.showLoader = false;
                        callback();
                      }, 2000); 


                    }, function errorCallback(response) {
                        console.log(response.statusTex);
                    });
            }
          }
});

app.factory('bookcoverModel', function () {
    return  {
              bookcover: function (idtemp, imagetemp, titletemp, authortemp, colorTag, categoryTag) {
                return { id: idtemp, image: imagetemp, title: titletemp, author: authortemp, color: colorTag, category: categoryTag }
              },

              category: function (idtemp, name, src, flag) {
                return { id: idtemp, imageOrColor: src, label: name, isImage: flag }
              },

              subcategory: function(idTemp, nameTemp, imageTemp, flag) {
                  return {id: idTemp, image: imageTemp, name: nameTemp, isImage: flag }
              }

            }
});


app.directive('myBookList', [ 'redirectToDescription', '$location', function (redirectToDescription, $location) {
    return {
        restrict: 'A',
        link: function ($scope, element, attributes) {
            element.bind('click', function () {
                redirectToDescription.whenClick(element, $location.path());
            });
        }
    }
}]);

app.controller('bookCoverController', function ($scope, $http, getBookCover, bookcoverModel, $timeout) {
    $scope.maximum = 30;
    $scope.lastIndexPaginate = 0;
    $scope.firstIndexPaginate = 0;
    $scope.paginateCount = 0;
    $scope.forPagination = [];
    $scope.firstSetOfBooks = [];
    $scope.bookcovers = [];
    $scope.filters = [];
    $scope.subcategories = [];
    $scope.selectedCategoryId;
    $scope.enableScroll = true;

    $scope.showLoading = true;


    angular.element(document).ready(function () {
        getBookCover.paginate($http, 0, $scope, bookcoverModel);
        $scope.firstSetOfBooks = $scope.bookcovers;
        $('#bookscontainer').slimscroll({
          height: '320px',
          axis: 'x'
        }).bind('slimscrollX', function(e, pos) {
              switch(pos) {
                case 'right': 
                  if($scope.enableScroll) {
                    getBookCover.paginate($http, $scope.bookcovers.length, $scope, bookcoverModel);
                  }
                break;
              }

        });
    });

    var count = 0;

    $scope.filter = function(el) {
       $scope.enableScroll = false;
       var elem = angular.element(el.currentTarget);
       var id = angular.element(elem.children()[0]).val();
       var name = angular.element(elem.children()[2]).text();
       var imgOrColor = angular.element(elem.children()[1]);
       if(imgOrColor.attr("src") != undefined) {
           doSomethingIfNotExist($scope.filters, id, true, function() {
            $scope.filters.push(bookcoverModel.category(id, name, imgOrColor.attr("src"), true));
          });

          getBookCover.filter($http, $scope, bookcoverModel, id, true);
       } else {
           doSomethingIfNotExist($scope.filters, id, false, function() {
            $scope.filters.push(bookcoverModel.category(id, name, imgOrColor.css("background-color"), false));
          });

          getBookCover.filter($http, $scope, bookcoverModel, id, false);
       }
       hideModal();
       $scope.showLoading = false;
    };


    $scope.actionNext = function() {
     $('#bookscontainer').slimscroll({ scrollByX: '50px'});
    };

    $scope.actionPrev = function() {
      $('#bookscontainer').slimscroll({ scrollByX: '-50px'});
    };


    $scope.undoSearch = function() {
       $scope.bookcovers = $scope.firstSetOfBooks;
       $scope.showLoading = true;
       $scope.enableScroll = true;
       $scope.filters = [];
    };

    $scope.remove = function (el) {
        var elem = angular.element(el.currentTarget);
        var id = angular.element(elem.children()[0]).val();
        angular.forEach($scope.filters, function(value, key) {
            if(value.id == id && value.isImage == (angular.element(elem.children()[1]).attr('src') != undefined)) {
              $scope.filters.splice(key, 1);
            }
        });

        if($scope.filters.length == 0) {
            $scope.bookcovers = $scope.firstSetOfBooks;
            $scope.showLoading = true;
            $scope.enableScroll = true;
        } else {
            var url = "/childrenslibrarywithyii/web/index.php/browsebook/queryfilterwhenremove?";
            var counter = 0; 
            var counterForCat = [];
            var counterForColor = [];


            angular.forEach($scope.filters, function(value, key) {
                if(value.isImage) {
                  counterForCat.push(value.id);
                } else {
                  counterForColor.push(value.id);
                }
            });

            if(counterForCat.length != 0) {
              url += "idOfCat=" + counterForCat.join(",");
            }

            if(counterForColor.length != 0) {
              if(counterForCat.length > 0) {
                url += "&";
              }
              url += "idOfColor=" + counterForColor.join(",");
            } 
          getBookCover.remove($http, $scope, bookcoverModel, url);
          $scope.showLoading = false;
        }

    };


    $scope.getSubCategories = function(el) {
        var filter = document.getElementById('filtered');
        filter.style.display = "none";
        var elem = angular.element(el.currentTarget);
        var id = angular.element(elem.children()[0]).val();
        $scope.selectedCategoryId = id;
        $scope.subcategories = [];
        var url = "/childrenslibrarywithyii/web/index.php/browsebook/getsubcategories?id=" + id;
        getBookCover.getSubCategories($http, $scope, bookcoverModel, url, $timeout, showModal);

    };

    $scope.showSearchInput = function() {
      var modal = document.getElementById("my-second-modal");
      modal.style.display = "block";
    };

    $scope.hideSearchInput = function() {
      var modal = document.getElementById("my-second-modal");
      modal.style.display = "none";
    };


    $scope.hideModal = function(el) {
      hideModal();
    };

    $scope.nextCategory = function(el) {
        $scope.showPrev = $scope.showPrev ? $scope.showPrev : true;
        var tempObject = paginateArray($scope.forPagination, $scope.lastIndexPaginate, true, $scope.maximum);
        $scope.paginateCount = $scope.paginateCount + tempObject.values.length;

        if($scope.paginateCount == ($scope.forPagination.length - 1)) {
          $scope.showNext = false;
        }
        $scope.lastIndexPaginate = tempObject.lastIndex;
        $scope.firstIndexPaginate = tempObject.firstIndex;
        $scope.subcategories = tempObject.values;
    };

    $scope.prevCategory = function(el) {
      $scope.showNext = $scope.showNext ? $scope.showNext : true;
      var tempObject = paginateArray($scope.forPagination, $scope.firstIndexPaginate, false, $scope.maximum);
      $scope.paginateCount = $scope.paginateCount - $scope.subcategories.length;
      if($scope.paginateCount == $scope.maximum) {
          $scope.showPrev = false;
      }
      $scope.lastIndexPaginate = tempObject.lastIndex;
      $scope.firstIndexPaginate = tempObject.firstIndex;
      $scope.subcategories = tempObject.values;
    };

    $scope.searhAction = function() {
        var input = $scope.search;
        $scope.search = "";
        getBookCover.search($http, input, $scope, bookcoverModel);
        $scope.hideSearchInput();

    };
});

function doSomethingIfNotExist(obj, id, isImage, callback) {
    var flag = true;
    if(obj.length == 0) {
        callback();
    } else {
        obj.forEach(function(elem) {
            if(elem.id == id && elem.isImage == isImage) {
                flag = false;
            }
        });

        if(flag) {
           callback();
        }
    }
}

function showModal() {
  var modal = document.getElementById('my-modal');
  modal.style.display = "block";
}

function hideModal() {
  var modal = document.getElementById('my-modal');
  var filter = document.getElementById('filtered');
  modal.style.display = "none";
  filter.style.display = "block";
}


function paginateArray(arrayObject, lastorFirstindex, isNext, maximum) {
  var size = arrayObject.length;
  var lastIndexPaginate = 0;
  var firstIndexPaginate = 0;
  var result = null;
  if(isNext) {
    //next
    firstIndexPaginate = lastorFirstindex + 1;
    if(firstIndexPaginate < size) {
        lastIndexPaginate = maximum + lastorFirstindex;
        if(lastIndexPaginate > size) {
          lastIndexPaginate = firstIndexPaginate + (size  - firstIndexPaginate);
        }
        result = arrayObject.slice(firstIndexPaginate, (lastIndexPaginate + 1));
    }
  } else {
    // prev
    lastIndexPaginate = lastorFirstindex - 1;
    if(lastIndexPaginate > 0) {
      firstIndexPaginate = lastorFirstindex - maximum;
       result = arrayObject.slice((firstIndexPaginate - 1), lastIndexPaginate);
    }
  }

  if(result != null) {
     return { firstIndex:  firstIndexPaginate, lastIndex: lastIndexPaginate, values: result };
  }

  return null;
 
}


