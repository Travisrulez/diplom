<!doctype html>
<html lang='en'>
<?php 
include("app/database.php");
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
if(isset($_POST['submit'])) {
    $fname = $_FILES['file']['name'];
    $temp = $_FILES['file']['tmp_name'];
    $fsize = $_FILES['file']['size'];
    $extension = explode('.',$fname);
    $extension = strtolower(end($extension));  
    $fnew = uniqid().'.'.$extension;
    $store = "assets/docs/".basename($fnew);                  
    if($extension == 'pdf'||$extension == 'doc'||$extension == 'docx') {        
        if ($fsize>=1000000) {
            $error = 	'<div class="modal error">
                            Максимальный размер изображения 1 Mb!
                        </div>';
        } else {
            $sql = "INSERT INTO request(name, title, status, birthday, email, phone, pages, director, place, phile) VALUE('".$_POST['name']."','".$_POST['title']."','".$_POST['status']."','".$_POST['birthday']."','".$_POST['email']."','".$_POST['phone']."','".$_POST['pages']."','".$_POST['director']."','".$_POST['place']."','".$fnew."')";
            mysqli_query($link, $sql); 
            move_uploaded_file($temp, $store);

            $success = 	'<div class="modal success">
                            Запись успешно добавлена!
                        </div>';
        }
    } elseif ($extension == '') {
        $error = 	'<div class="modal error">
                        Необходимо выбрать изображение!
                    </div>';
    } else {
        $error = 	'<div class="modal error">
                        Допустимые форматы изображения: PNG, JPEG, GIF!
                    </div>';
    }
    // $_SESSION['error'] = $error;
    // $_SESSION['success'] = $success;
    header("location:index.php");
}
?>
<head>
  <meta charset='UTF-8'>
  <meta name='viewport'
    content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
  <meta http-equiv='X-UA-Compatible' content='ie=edge'>
  <link rel="stylesheet" href="./styles/css/style.css">
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" /> -->
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
  <script src="scripts/wow.js" defer></script>
  <script src="scripts/modal.js" defer></script> -->
  <title>Конференция</title>
</head>
<body>
  <div class="app">
<header class='header'>
      <div class='header__container container'>
        <h1 class='header__title h1'>Язык, сознание, коммуникация</h1>
        <button class='header__btn btn'>
          <img src='assets/icons/user.svg' />
        </button>
      </div>
      <span class='decor-letter'>Я</span>
    </header>

  <main>
    <section class='overview wow'>
      <div class='overview__container container'>
        <div class='overview__wrapper'>
          <p class='overview__description'>
            Московский политехнический университет проводят Международную конференцию «Язык, сознание, коммуникация: проблемы информационного общества» 3-5 апреля 2023 г. формат: онлайн, в рамках «Недели медицинского образования – 2023», на платформе Сеченовского университета
          </p>
          <div class='overview__badges'>
            <div class='overview__badge badge'>12 ноября 2023</div>
            <div class='overview__badge badge'>Онлайн</div>
            <div class='overview__badge badge'>Русский</div>
          </div>
          <a href="request.php" class='overview__btn btn open-modal-btn'>Подать заявку</a>
        </div>
      </div>
    </section>

    <section class='problems wow'>
      <div class='problems__container container'>
        <h2 class='problems__title h2'>Проблематика</h2>
        <div class='problems__items'>
          <div class='problems__item card'>01. Речевая деятельность: методология и теория исследований</div>
          <div class='problems__item card'>02. Языковое и неязыковое сознание: проблемы онтологии и гносеологии.</div>
          <div class='problems__item card'>03. Мультимодальность как свойство современной коммуникации.</div>
          <div class='problems__item card'>04. Новые медиа как объект психолингвистических исследований.</div>
          <div class='problems__item card'>05. Психолингвистический анализ медиаконтента в мультимодальном аспекте.</div>
          <div class='problems__item card'>06. Психолингвистические методики и нейросетевые технологии в обработке речевых данных.</div>
          <div class='problems__item card'>07. Цифровые технологии в социокультурной сфере.</div>
          <div class='problems__item card'>08. Психолингвистический анализ больших данных.</div>
          <div class='problems__item card'>09. Текст в новых условиях коммуникации. Моделирование текстов.</div>
          <div class='problems__item card'>10. Языковая способность: норма и патология.</div>
          <div class='problems__item card'>11. Язык и социум.</div>
          <div class='problems__item card'>12. Межкультурная коммуникация.</div>
        </div>
      </div>
    </section>

    <section class='terms wow'>
      <div class='terms__container container'>
        <div class='terms__info'>
          <div class='terms__title h2'>
            Условия участия
          </div>
          <ul class='terms__description'>
            <li>От одного автора принимается не более двух научных работ.</li>
            <li>Объем текста не должен превышать 2-х страниц формата А4 в текстовом редакторе Microsoft Word, в формате *doc (на русском языке; шрифт Times New Roman, 14 пт; межстрочный одинарный интервал, правое поле – 1,5 см, остальные – 2,0 см; абзацный отступ – 1,25 см, выравнивание текста по ширине страницы, без переносов, рисунков, таблиц и формул).</li>
            <li>ВАЖНО! Письменная электронная копия согласия автора (-ов) на обработку электронной версии публикации и передачу ее третьим лицам для обработки в специальных системах для размещения в системе РИНЦ.</li>
          </ul>
        </div>
        <div class='terms__image'>
          <img src='assets/images/terms.png' alt='terms-image' />
        </div>
      </div>
    </section>

    <section class='stages wow bounceInUp'>
      <div class='stages__container container'>
        <h2 class='stages__title h2'>Этапы конференции</h2>
        <div class='stages__items'>
          <div class='stages__item'>
            <div class='stages__item-date card'>12 марта – 24 марта</div>
            <p class='stages__item-title'>01 Подача заявлений</p>
            <p class='stages__item-description'>На первом этапе вы подаёте заявку со своим докладом и его проверяют модераторы</p>
          </div>
          <div class='stages__item'>
            <div class='stages__item-date card'>24 марта – 05 апреля</div>
            <p class='stages__item-title'>01 Подача заявлений</p>
            <p class='stages__item-description'>На первом этапе вы подаёте заявку со своим докладом и его проверяют модераторы</p>
          </div>
          <div class='stages__item'>
            <div class='stages__item-date card'>06 апреля – 24 апреля</div>
            <p class='stages__item-title'>01 Подача заявлений</p>
            <p class='stages__item-description'>На первом этапе вы подаёте заявку со своим докладом и его проверяют модераторы</p>
          </div>
        </div>
      </div>
    </section>

    <section class='sponsor wow bounceInUp'>
      <div class='sponsor__container container'>
        <h2 class='sponsor__title h2'>Организаторы</h2>
        <div class='sponsor__items'>
          <div class='sponsor__item'>
            <div class='sponsor__item-img'><img src='assets/images/user.png' /></div>
            <div class='sponsor__item-name'>Петров<br> Александр Сергеевич</div>
            <div class='sponsor__item-subtitle'>Преподаватель</div>
          </div>
          <div class='sponsor__item'>
            <div class='sponsor__item-img'><img src='assets/images/user.png' /></div>
            <div class='sponsor__item-name'>Петров<br> Александр Сергеевич</div>
            <div class='sponsor__item-subtitle'>Преподаватель</div>
          </div>
          <div class='sponsor__item'>
            <div class='sponsor__item-img'><img src='assets/images/user.png' /></div>
            <div class='sponsor__item-name'>Петров<br> Александр Сергеевич</div>
            <div class='sponsor__item-subtitle'>Преподаватель</div>
          </div>
          <div class='sponsor__item'>
            <div class='sponsor__item-img'><img src='assets/images/user.png' /></div>
            <div class='sponsor__item-name'>Петров<br> Александр Сергеевич</div>
            <div class='sponsor__item-subtitle'>Преподаватель</div>
          </div>
        </div>
      </div>
    </section>

    <section class='application wow bounceInUp'>
      <div class='application__container container card'>
        <h2 class='application__title h2'>Подача заявки</h2>
        <div class='application__info'>
          <p class='application__description'>
            Если вы готовы оставить заявку, нажмите на кнопку и заполните форму со всеми предложенными данными
          </p>
          <a href="request.php" class='application__btn btn open-modal-btn'>Подать заявку</a>
        </div>
        <span class='decor-letter'>Я</span>
      </div>
    </section>
  </main>

  <!-- <div class='overlay'></div>
  <div class='modal'>
    <form method='post' enctype="multipart/form-data">
      <div class='modal__title'>Подача заявки</div>
      <div class='modal__inputs'>
        <div class='input-container'>
          <label class='label' for='fullname'>ФИО</label>
          <input class='input' id='fullname' name="name" placeholder='Введите ФИО' />
        </div>
        <div class='input-container'>
          <label class='label' for='status'>Статус</label>
          <input class='input' id='status' name="status" placeholder='Введите статус' />
        </div>
        <div class='input-container'>
          <label class='label' for='dateOfBirth'>Дата рождения</label>
          <input class='input' id='dateOfBirth' name="birthday" placeholder='Введите дату рождения' />
        </div>
        <div class='input-container'>
          <label class='label' for='email'>Email</label>
          <input class='input' type='email' name="email" id='email' placeholder='Введите Email' />
        </div>
        <div class='input-container'>
          <label class='label' for='phone'>Контактный телефон</label>
          <input class='input' id='phone' name="phone" placeholder='Введите контектный телефон' />
        </div>
        <div class='input-container'>
          <label class='label' for='articleTitle'>Название статьи</label>
          <input class='input' id='articleTitle' name="title" placeholder='Введите название статьи' />
        </div>
        <div class='input-container'>
          <label class='label' for='director'>Научный руководитель</label>
          <input class='input' id='director' name="director" placeholder='Введите руководителя' />
        </div>
        <div class='input-container'>
          <label class='label' for='pageSize'>Кол-во страниц</label>
          <input class='input' type='number' name="pages" id='pageSize' placeholder='Введите кол-во страниц' />
        </div>
        <div class='input-container'>
          <label class='label' for='place'>Место работы</label>
          <input class='input' id='place' name="place" placeholder='Введите место работы' />
        </div>
        <div class='input-container'>
          <label class='label' for='file'>Поле прикрепления файла</label>
          <input class='input' type='file' name="file" id='file' placeholder='asd' />
        </div>
      </div>

      <input class='modal__btn btn' type='submit' name='submit' value="Подать заявку"></input>
    </form>
  </div> -->
</div>
</body>
</html>