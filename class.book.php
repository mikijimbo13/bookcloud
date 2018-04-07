<?php

require_once('class.Database.php');

class BOOK
{

    private $conn;

    public function __construct()
    {
        $database = Database::getInstance();
        $db = $database->getConnection();
        $this->conn = $db;
    }

    public function registerBook($bowner, $bname, $bauth, $bgenre,$bcont){
        try
        {
            $stmt = $this->conn->prepare("INSERT INTO books(book_genre,book_name,book_auth,book_cont,book_owner) 
		                                               VALUES(:bgenre,:bname,:bauth,:bcont,:bowner)");

            $stmt->bindparam(":bgenre", $bgenre);
            $stmt->bindparam(":bname", $bname);
            $stmt->bindparam(":bauth", $bauth);
            $stmt->bindparam(":bcont", $bcont);
            $stmt->bindparam(":bowner", $bowner);

            $stmt->execute();

            return $stmt;
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }

    public function findBooks($uname, $bgenre, $bname ,$bauth , $limit, $offset)
    {
        $none = true;
        $first = true;
        $sql = "SELECT book_id, book_genre, book_name, book_auth, book_cont, book_owner FROM books WHERE";
        if($uname!=""){
            $sql .=" book_owner='".$uname."'";
            $none = false;
            $first = false;
        }

        if($bgenre!=""){
            if(!$first) {
                $sql .= " OR";
            }
            $sql .=" book_owner='".$bgenre."'";
            $none = false;
            $first = false;
        }
        if($bname!=""){
            if(!$first) {
                $sql .= " OR";
            }
            $sql .=" book_owner='".$bname."'";
            $none = false;
            $first = false;
        }
        if($bauth!=""){
            if(!$first) {
                $sql .= " OR";
            }
            $sql .=" book_owner='".$bauth."'";
            $none = false;
        }
        if($none) {
            $sql .= " 1";
        }
        $sql .=" LIMIT ".$limit." OFFSET ".$offset;
        try
        {

            $stmt = $this->conn->prepare($sql);

            $stmt->execute();
            $count = $stmt->rowCount();
            //echo '<div class="container-fluid">';
            for($i = 0; $i<$count; $i++){
                if($i % 3 == 0){
                    echo '<div class="row">';
                }
                $row=$stmt->fetch(PDO::FETCH_ASSOC);
                echo '<div class="col-md-4">
                            <div class="book">
                                <div class="book_name">Book name: ' .  $row['book_name'].'</div>
                                <div class="book_author">Book author: '.$row['book_auth'].'</div>
                                <div class="book_genre">Book genre: '.$row['book_genre'].'</div>
                                <div class="book_link"><a href="bookdetail.php?book='.$row['book_id'].'">More</a></div>
                            </div>    
                     </div>';
                if($i % 3 == 2){
                    echo '</div>';
                }
            }

        }
        catch(PDOException $e)
        {
            echo $sql;
            echo $e->getMessage();
        }
    }

    public function bookDetail($book_id){
        try
        {
            $sql = "SELECT * FROM books WHERE book_id=:bookid";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindparam(":bookid", $book_id);
            $stmt->execute();
            $count = $stmt->rowCount();
            //echo '<div class="container-fluid">';

                $row=$stmt->fetch(PDO::FETCH_ASSOC);
                echo '<div class="row book_big"> 
                        <div class="col-md-4 book_big_img">
                            <img src="img/book-stock.jpeg" width="30%" alt="Book image">
                        </div>
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-12 book_big_name">Book name: ' . $row['book_name'].'</div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 book_big_author">Book author: '.$row['book_auth'].'</div>
                            </div>
                            <div class="row">                                
                                <div class="col-md-12 book_big_genre">Book genre: '.$row['book_genre'].'</div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 book_big_owner">Book owner: '.$row['book_owner'].'</div>
                            </div>
                        </div>    
                        <div class="row">
                            <div class="col-md-12 book_big_content_label">Book content: </div>
                            <div class="col-md-12 book_big_content">'.$row['book_cont'].'</div>
                        </div>
                      </div>';



        }
        catch(PDOException $e)
        {
            echo $sql;
            echo $e->getMessage();
        }
    }
}
