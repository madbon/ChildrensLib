<div class="container-fluid" style="margin-top: 40px;" ng-controller="bookCoverController">
        <div id="faded-custom" style="z-index: 2000" class="my-custom-faded" ng-init="showLoader = false" ng-show="showLoader">
            <img class="faded-content" src="/childrenslibrarywithyii/web/images/super-mario.gif">
        </div>
        <!-- The Modal -->
            <div id="my-modal" class="custom-modal" style="z-index: 2000">

              <!-- Modal content -->
              <div class="panel panel-default custom-modal-content">
                <span class="custom-close" ng-click="hideModal()">&times;</span>
                <div class="custom-modal-body">
                  <center>  
                     <div style="width:8%; height: 100px; margin: 10px; display: inline-block;" ng-repeat="subcategory in subcategories" ng-click="filter($event)" id="subcatscroll">
                            <input type="hidden" value="{{ subcategory.id }}">
                             <img src="/childrenslibrarywithyii/web/upload_categorycontentimages/{{ (subcategory.image == '') ? 'blank.jpg' : subcategory.image }}"style="display: inline-block; width: 100%; height: 65%; padding: 0; border-radius: 40px;" class="button" ng-if="subcategory.isImage">
                              <img style="background-color: {{ subcategory.image }}; padding: 0;  display: inline-block; width: 100%; height: 65%; border-radius: 40px;" class="button" ng-if="!subcategory.isImage">
                            <div style="font-size:100%; text-align: center; display: block; margin-top: 10px;">{{ subcategory.name }}</div>
                      </div>
                  </center>
                  <a class="custom-prev" ng-show="showPrev" ng-click="prevCategory()">&#10094;</a>
                  <a class="custom-next" ng-show="showNext" ng-click="nextCategory()">&#10095;</a>
                </div>
              </div>
            </div>

        <!-- The Modal -->
            <div id="my-second-modal" class="custom-modal" style="z-index: 2000">

              <!-- Modal content -->
              <div class="panel panel-default custom-modal-content">
                <span class="custom-close" ng-click="hideSearchInput()">&times;</span>
                <div class="custom-modal-body">
                    <form>
                      <div class="input-group">
                        <input type="text" ng-model="search" class="form-control" placeholder="Search" style="font-size: 40px; padding: 30px 12px;">
                        <div class="input-group-btn">
                          <button class="btn btn-default" style="padding: 12.7px 12px;" ng-click="searhAction()">
                            <i class="glyphicon glyphicon-search" style="font-size: 30px;"></i>
                          </button>
                        </div>
                      </div>
                    </form>
                </div>
             </div>

            </div>
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3 col-xm-3" style="height: 580px; border-radius: 20px; padding: 0;">
                <div style="height: 520px; white-space:nowrap">
                    <div class="row" style="margin-left: 55px; margin-right: -55px;">
                        <?php foreach($categories as $category): ?>
                        <div class="col-lg-5">
                            <div style="width:80%; height: 130px;" ng-click="getSubCategories($event)">
                                <input type="hidden" value="<?= $category->id ?>">
                                <?php if ($category->image == "color"): ?>
                                    <div style="background: linear-gradient(to right, red,orange,yellow,green,blue,indigo,violet); width: 100%; height: 65%; border-radius: 40px;" class="button"></div>
                                <?php else: ?>
                                      <img src="<?= "/childrenslibrarywithyii/web/upload_categoryimages/" . $category->image ?>" style="width: 100%; height: 65%; padding: 0; border-radius: 40px;" class="button">
                                <?php endif ?>
                                <div style="font-size:100%; text-align: center; display: block; margin-top: 10px;"><?= $category->title ?></div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-8 col-xm-8">
                <div class="panel panel-default" style="border-radius: 20px; padding-left: 10px; padding-right: 10px; padding-bottom: 10px; height: 500px;">
                    <br>
                    <h1 style="text-shadow: 3px 0 black, 0 1px black, 1px 0 black, 0 -1px black;text-align: center; font-family: 'Asap', sans-serif; font-weight: bold; line-height: 30px; font-size: 4em; color: rgb(162,192,231);">
                    Children's StoryPlace</h1>
                    <br/>
                    <h2 style="text-shadow: 3px 0 black, 0 1px black, 1px 0 black, 0 -1px black; text-align: center;  font-size: 40px; text-transform: uppercase; font-weight: bolder; font-family: arial black, sans-serif; color:rgb(233,116,54);"> <i class="fa fa-book" style="color:rgb(66,61,59);"></i> Browse to Amaze <i class="fa fa-child" style="color:rgb(153,51,153); font-size: 70px;"></i></h2>
                    <div id="filtered" ng-show="filters.length != 0" style=" z-index: 1; width: 50%; margin: 0 auto; height: 100px; position: absolute; left: 0; right: 0; overflow-x: hidden; overflow-y: hidden; white-space:nowrap">
                        <div style="width:8%; height: 100px; margin: 10px; display: inline-block;" ng-click="remove($event)" ng-repeat="filter in filters">
                            <input type="hidden" value="{{ filter.id }}">
                            <img src="{{ filter.imageOrColor }}" ng-if ="filter.isImage" style="display: inline-block; width: 100%; height: 40%; padding: 0; border-radius: 40px;" class="button">
                            <img style="background-color: {{ filter.imageOrColor }}; padding: 0;  display: inline-block; width: 100%; height: 40%; border-radius: 40px;" class="button" ng-if="!filter.isImage">
                            <i class="fa fa-plus" aria-hidden="true" ng-if="filters.length > 1 && filters.length != ($index + 1) "></i>
                            <div style="font-size:100%; text-align: center; display: block; margin-top: 10px;">{{ filter.label }}</div>
                        </div>
                    </div>
                    <div class="panel-body" style="margin-top: 60px;border-radius: 20px; background-color: #1ab7ea; height: 350px; position: absolute; width: 94.6%;">
                        <i class="fa fa-angle-left arrow" aria-hidden="true" style="font-weight: bolder; color: rgb(40,41,35); font-size: 250px; left: 10px;vertical-align: middle; cursor: pointer; line-height: 300px; position: absolute; z-index: 1000;" ng-click="actionPrev()"></i>
                        <i class="fa fa-angle-right arrow" aria-hidden="true" style="font-weight: bolder; color: rgb(40,41,35); font-size: 250px; right: 10px; vertical-align: middle; cursor: pointer; line-height: 300px; position: absolute; z-index: 1000;" ng-click="actionNext()"></i>
                        <div id="bookscontainer" style="height: 320px; padding: 20px; padding-top: 40px; margin: 0 1%; white-space:nowrap">
                            <div style="width: 200px; display: inline-block; padding-right: 10px; cursor: pointer" ng-repeat="bookcover in bookcovers" my-book-list>
                                    <input type="hidden" value="{{ bookcover.id }}">
                                    <img src="/childrenslibrarywithyii/web/upload_bookcover/{{ bookcover.image }}" style="width: 100%; height: 200px;">
                                    <div style="text-align: center; font-size: 100%">{{ bookcover.title }}</div>
                                    <div style="text-align: center; font-size: 100%">{{ bookcover.author }}</div>
                            </div>
                            <div ng-show="showLoading" style="width: 200px; display: inline-block; padding-right: 10px; cursor: pointer; height: 200px;">
                                <div class="loader" style="margin: 0 auto; margin-bottom: 10px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="btn-group">
            <a href="javascript:void(0)" class="btn btn-primary btn-fab" id="main" ng-click="showSearchInput()">
              <i class="material-icons fa fa-search"></i>
            </a>
        </div>
        <div class="btn-group">
            <a href="javascript:void(0)" class="btn btn-primary btn-fab" id="default" ng-click="undoSearch()">
              <i class="material-icons glyphicons fa fa-undo"></i>
            </a>
        </div>

 </div>



