<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <!--<link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">-->
    
    
    <!--<link rel="stylesheet" href="../css/login.css">-->
    <link rel="stylesheet" href="../assets/css/font-awesome.css">
    
    <link rel="stylesheet" href="../css/css/fontawesome-all.min.css">

    <link rel="stylesheet" href="../assets/bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/bootstrap-5.0.2-dist/js/bootstrap.min.js">
</head>
<body>
<section class="vh-100" style="background-color: #9A616D;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-xl-10">
        <div class="card" style="border-radius: 1rem;">
          <div class="row g-0">
            <div class="col-md-6 col-lg-5 d-none d-md-block">
              <img src="https://www.referenseo.com/wp-content/uploads/2019/03/image-attractive-960x540.jpg"
                alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
            </div>
            <div class="col-md-6 col-lg-7 d-flex align-items-center">
              <div class="card-body p-4 p-lg-5 text-black">

                <form action="login.php" method="POST">
                  <div class="d-flex align-items-center mb-3 pb-1">
                    <i class="fas fa-users fa-2x me-3" style="color: #ff6219;"></i>
                    <span class="h1 fw-bold mb-0">Logo</span>
                  </div>

                  <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your account</h5>

                  <div class="form-floating mb-4">
                    <input type="email" class="form-control" id="login" name="login">
                    <label for="login">Email adresse</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="mdp"name="mdp">
                    <label for="mdp">Mot de passe</label>
                </div>

                  <div class="pt-1 mb-4">
                    <button type="submit" class="btn btn btn-dark btn-lg btn-block">Se connecter </button>
                  </div>

                  <a class="small text-muted" href="#!">Mot de passe oublié?</a>
                </form>
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>
</html>