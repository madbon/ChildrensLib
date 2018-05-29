<div class="container">
    <div id="overlay">
       <ul id="pictures" class="main-slider gallery list-unstyled" style="margin: 0;">
          <?php if (count($bookcontent)): ?>
            <?php foreach ($bookcontent as $value): ?>
              <li data-original="/childrenslibrarywithyii/web/upload_bookcontentimages/<?= $value->BOOKPAGES_IMAGE ?>"> 
                  <img src="/childrenslibrarywithyii/web/upload_bookcontentimages/<?= $value->BOOKPAGES_IMAGE ?>" />
              </li>
            <?php endforeach ?>
          <?php endif ?>
      </ul>
    </div>
    <div class="panel panel-default" style="margin: 40px 0px;">
        <div class="panel-heading" style="text-align: center; background-color: #1ab7ea; color: white">
          <a class="btn" style="float: left; font-size: 50px" href="http://localhost/childrenslibrarywithyii/web/browsebook"><i class="fa fa-home"></i></a>
          <h1>About the Book</h1>
        </div>
            <div class="panel-body">
                <div class="row" style="margin: 0 0px; margin-bottom: 10px;">
                    <div class="col-lg-5 bookcover-container">
                        <div class="bookcover">
                            <img src="/childrenslibrarywithyii/web/upload_bookcover/<?= $description->BOOKCOVER_IMAGE?>">
                        </div>
                        <div class="middle">
                          <div class="text" id="readmore" >Read More</div>
                        </div>
                    </div>
                    <div class="col-lg-7 bookcoverdescription">
                        <h1><b><?= $description->BOOK_TITLE; ?></b></h1>
                        <p><?= $description->BOOK_SUMMARY; ?></p>
                        <div class="row">
                            <div class="col-lg-5 col-lg-offset-1">
                                <table class="table table-responsive" style="text-align: justify; ">
                                    <tr>
                                       <td>
                                           <b>Author:</b>
                                       </td>
                                       <td style="width: 250px;">
                                           <?= $description->BOOK_AUTHOR ?>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>
                                           <b>Publisher:</b>
                                       </td>
                                       <td style="width: 250px;">
                                           <?= $description->BOOK_PUBLISHER ?>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>
                                           <b>Illustrator:</b>
                                       </td>
                                       <td style="width: 250px;">
                                           <?= $description->BOOK_ILLUSTRATOR ?>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>
                                           <b>Pablication Date:</b>
                                       </td>
                                       <td style="width: 250px;">
                                           <?= $description->BOOK_PUBLICATIONDATE ?>
                                       </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-lg-5">
                                 <table class="table table-responsive">
                                    <tr>
                                       <td>
                                           <b>Number of page:</b>
                                       </td>
                                       <td>
                                           <?= $description->BOOKCOUNT_PAGES ?>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>
                                           <b>ISBN:</b>
                                       </td>
                                       <td>
                                           <?= $description->ISBN ?>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>
                                           <b>Library Code:</b>
                                       </td>
                                       <td>
                                           <?= $description->CODELIBRARY ?>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>
                                           <b>Location: </b>
                                       </td>
                                       <td>
                                           <?= $description->LOCATION ?>
                                       </td>
                                    </tr>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <ul id="content-slider" class="content-slider">
                    <?php if (count($bookcontent)): ?>
                        <?php $count = 0; ?>
                      <?php foreach ($bookcontent as $value): ?>
                        <li class="thumbnail" data-id="<?= $count++; ?>">
                            <div>
                                <img src="/childrenslibrarywithyii/web/upload_bookcontentimages/<?= $value->BOOKPAGES_IMAGE ?>">
                            </div>
                        </li>
                      <?php endforeach ?>
                        
                    <?php endif ?>
                </ul>
            </div>
        <div class="panel-footer" style="background-color: #1ab7ea"></div>
    </div>
</div>