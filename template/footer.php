</div><!--content-->
<?php
$conn3 = connect(); 
$show_users_online = showUsersOnline($conn3);
close($conn3);
?>   
<footer class="footer navbar-dark bg-dark mt-5">
      <div class="container pt-5 pb-5">
        <div class="row">
          <div class="col-lg-8">
            <p class="users-online text-light">Пользователи сейчас на сайте:</p>
            <div class="wrap-users-online">
              <?php echo $show_users_online;?>
            </div>
          </div>
          <div class="col-lg-4">
            <a href="/"><button class="btn btn-primary mr-2">Main Page</button></a>
            <a href='/admin' title="Для перехода в админ панель нужно зайти под ником 'Marc_Crass'"><button class="btn btn-danger mr-2">админка</button></a>
            <a href="/admin-create" title="Что бы добавлять статьи нужно зайти под ником 'Marc_Crass'"><button class="btn btn-success">Add new</button></a>
          </div>
        </div>
      </div>
    </footer>
</div><!--wrap-->
 <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>