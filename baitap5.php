<?php 
    include_once('header.php');
    include_once('nav.php');
    include_once('model/book.php');
    
    if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'add'){
        if($_REQUEST['id'] && $_REQUEST['title'] && $_REQUEST['price'] && $_REQUEST['author'] && $_REQUEST['year']){
            Book::add($_REQUEST['id'],$_REQUEST['title'],$_REQUEST['price'],$_REQUEST['author'],$_REQUEST['year']);
        }
    }
    if(isset($_REQUEST['action']) &&$_REQUEST['action'] == 'delete'){
        Book::delete($_REQUEST['id']);
    }
    if(isset($_REQUEST['action']) &&$_REQUEST['action'] == 'edit'){
        if($_REQUEST['id'] && $_REQUEST['title'] && $_REQUEST['price'] && $_REQUEST['author'] && $_REQUEST['year']){
            Book::edit($_REQUEST['id'],$_REQUEST['title'],$_REQUEST['price'],$_REQUEST['author'],$_REQUEST['year']);
        }
    }
    $keyWord = isset($_REQUEST['search'])?$_REQUEST['search']:null;
    $books = Book::getList($keyWord);
    
?>

<div class="container pt-5">
    <div class="modal" id="form-add">
        <div class="modal-dialog">
            <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">form add</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <form action="" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="action" value="add">
                    <div class="form-group">
                        <label>ID</label>
                        <input class="form-control" type="text" name="id">
                    </div>
                    <div class="form-group">
                        <label>title</label>   
                        <input class="form-control" type="text" name="title">
                    </div>
                    <div class="form-group">
                        <label>price</label>   
                        <input class="form-control" type="number" name="price">
                    </div>
                    <div class="form-group">
                        <label>author</label>   
                        <input class="form-control" type="text" name="author">
                    </div>
                    <div class="form-group">
                        <label>year</label>   
                        <input class="form-control" type="text" name="year">
                    </div> 
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">submit</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </form>

            </div>
        </div>
    </div>
    
    <button class="btn btn-outline-info float-right" data-toggle="modal" data-target="#form-add"><i class="fas fa-plus-circle"></i> Thêm</button>
    <form action="" method="GET">
        <div class="form-group">
            <input class="form-control" value="<?php echo isset($_REQUEST['action']) && $_REQUEST['action']; ?>" name="search"  style="max-width: 200px; display:inline-block;" placeholder="Search">
            <button type="submit" class="btn btn-default" style="margin-left:-50px"><i class="fas fa-search"></i></button>
        </div>
    </form>
    <table class="table mt-5">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Price</th>
                <th>Author</th>
                <th>Year</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                foreach($books as $key => $value){
            ?>
            <tr>
                <td><?php echo $value->id ?></td>
                <td><?php echo $value->title?></td>
                <td><?php echo $value->price?></td>
                <td><?php echo $value->author?></td>
                <td><?php echo $value->year?></td>
                <td>
                    <div class="modal" id="form-edit-<?php echo $value->id?>">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">form edit with id: <?php echo $value->id?></h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <!-- Modal body -->
                            <form action="" method="POST">
                                <div class="modal-body">
                                <input type="hidden" name="action" value="edit">
                                <input type="hidden" name="id" value="<?php echo $value->id?>">
                                    <div class="form-group">
                                        <label>title</label>   
                                        <input class="form-control" type="text" value="<?php echo $value->title?>" name="title">
                                    </div>
                                    <div class="form-group">
                                        <label>price</label>   
                                        <input class="form-control" type="number" value="<?php echo $value->price?>" name="price">
                                    </div>
                                    <div class="form-group">
                                        <label>author</label>   
                                        <input class="form-control" type="text" value="<?php echo $value->author?>" name="author">
                                    </div>
                                    <div class="form-group">
                                        <label>year</label>   
                                        <input class="form-control" type="text" value="<?php echo $value->year?>" name="year">
                                    </div> 
                                </div>

                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">submit</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div>
                            </form>

                            </div>
                        </div>
                    </div>
                    <button class="btn btn-outline-warning" data-toggle="modal" data-target="#form-edit-<?php echo $value->id?>"><i class="fas fa-pencil-alt"></i> Edit</button>
                    <form action="" style=" display: inline-block;" method="POST">
                        <input type="hidden" name="action" value="delete"> 
                        <input type="hidden" name="id" value="<?php echo $value->id?>"> 
                        <button  class="btn btn-outline-danger"><i class="fas fa-trash-alt"></i> Delete</button>
                    </form>
                </td>
            </tr>    
            <?php 
                }
            ?>
        </tbody>
        
    </table>
    <!-- <div class="pagination">   
        <?php 
            $url = $_SERVER['REQUEST_URI'];
            $url = explode('?',$url)[0];
            $url .= '?';
            if(isset($_GET['search'])){
                $url .= $dau.'search='.$_GET['search'].'&';
            }
            for($i = 1; $i <= ceil($paginationBooks['size']/$mount); $i++){
                
        ?>
            <a <?php if($i == $paginationBooks['page_index'] ) echo "class='active'"; ?> href="<?php echo $url.'page='.$i; ?>"><?php echo $i?></a>
        <?php
            }
        ?>
    </div>  -->
</div>
<?php 
    include_once('footer.php');
?>
