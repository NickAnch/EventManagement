<?php
include_once ROOT. '/components/AdminBase.php';
include_once ROOT. '/models/Theme.php';

class AdminThemeController extends AdminBase {

  public function actionIndex(){

        self::checkAdmin();

        $themesList = Theme::getInterestsList();

        require_once(ROOT . '/views/admin_themes/index.php');
        return true;
  }

  public function actionCreate(){

        self::checkAdmin();
        $result = false;

        if (isset($_POST['addTheme'])){
          $theme = $_POST['theme'];
          $error = false;

          if (Theme::checkThemeExists($theme)){
            $error[] = 'Такая тема уже была добавлена!';
          }

          if ($error == false) {
              $result = Theme::createTheme($theme);
          }
        }

        require_once(ROOT . '/views/admin_themes/create.php');
        return true;
  }

  public function actionUpdate($id){

        self::checkAdmin();
        $theme = Theme::getThemeById($id);
        $interest = $theme['name_interest'];
        $result = false;

        if (isset($_POST['editTheme'])){
          $interest = $_POST['theme'];
          $error = false;

          if (Theme::checkThemeExists($interest)){
            $error[] = 'Такая тема уже была создана ранее!';
          }

          if ($error == false) {
              $result = Theme::updateThemeById($id, $interest);

          }
        }

        require_once(ROOT . '/views/admin_themes/update.php');
        return true;
  }

  public function actionDelete($id){
        self::checkAdmin();
        if (isset($_POST['deleteTheme'])) {
          $error = false;
          if (Theme::deleteThemeById($id)){
            header("Location: /admin/theme");
          } else {
            $error[]= 'Данная тема используется в других таблицах, она не может быть удалена!';
          }
        }

        require_once(ROOT . '/views/admin_themes/delete.php');
        return true;
    }

}

?>
