<!Doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>荻瑟特</title>
    <link rel="stylesheet" href="general.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
</head>

<body>
    <?php include_once("header.php"); ?>
    <main>
        <div class="container  overflow-hidden " style=" height:500px; ">
            <div class="row  gx-5 " style=" height:100%; ">
                <div class="col-sm align-self-center " style=" border-right:1px solid black; ">
                <h3>註冊</h3>
                    <form name="form" method="post" action="register_done.php">
                        <div class="form-group">
                            <label>姓名</label>
                            <input type="text" class="form-control" placeholder="請輸入姓名" id="name" name="name">
                        </div> 
                        <div class="form-group">
                            <label>手機號碼</label>
                            <input type="text" class="form-control" placeholder="請輸入手機號碼" id="phone" name="phone">
                        </div>
                        <div class="form-group">
                            <label>地址</label>
                            <input type="text" class="form-control" placeholder="請輸入地址" id="address" name="address">
                        </div>
                        <div class="form-group">
                            <label>電子信箱</label>
                            <input type="text" class="form-control" placeholder="請輸入Email" id="email" name="email">
                        </div>
                    </div>
                        <div class="col-sm align-self-center">
                            <div class="form-group">
                                <label>登入密碼</label>
                                <input type="password" class="form-control" placeholder="請輸入登入密碼" id="Password1" name="Password1">
                            </div>  
                            <div class="form-group">
                                <label>請再次輸入登入密碼</label>
                                <input type="password" class="form-control" placeholder="請再次輸入登入密碼" id="Password2" name="Password2">
                            </div> 
                            <div class="form-group">
                                <label>銀行帳號(宅配匯款用)</label>
                                <input type="text" class="form-control" placeholder="請輸入銀行帳號" id="account" name="account">
                            </div>
                            <div class="form-group"> 
                                <button type="submit" class="btn btn-primary" style="float:right" value="確定">註冊</button>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </main>
    <?php include_once("footer.php"); ?>
</body>

</html>

<style scoped>
    label {
        font-weight: bold;
        margin-top: 15px;
        margin-bottom: 5px;
        /* border:1px solid black;*/
    }

    .btn {
        margin-top: 15px;

    }
</style>