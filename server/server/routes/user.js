const express = require("express");
const { route } = require("express/lib/application");
const router = express.Router();
const userController = require("../controllers/userController");

const isAuth = (req, res, next) => {
  console.log("Middleware Called");
  if (req.session.isAuth) {
    next();
  } else {
    res.redirect("/");
  }
};

// router.get("/", userController.home);
router.post("/recipe-signup", userController.signup);
router.post("/submit-msg", userController.submitMsg);
router.post("/recipe", userController.login);
router.post("/showrecipefeed/:email", userController.recipefeed);
router.get("/userinfo/:email", isAuth, userController.userinfo);
router.get("/userinfo2/:email", userController.userinfo);


router.get("/logout/:email", userController.logout);
// router.get("/edituser/:email", isAuth, userController.edituser);
router.get("/edituser/:email", userController.edituser);
router.post("/updateuserinfo/:email", userController.update);
router.post("/getrecipe/:foodId", userController.getSpecifiRecipe);
// router.get("/Add_Recipe/:email", isAuth, userController.touploadrecipe);
router.post(
  "/submitrecipe",
  // isAuth,
  userController.submitrecipe
);

//ADMIN
router.post("/admin-login", userController.adminlogin);
router.get("/admin-logout/:email", isAuth, userController.adminlogout);
router.get("/msg-box", userController.msgBox);
router.delete("/userDelete", userController.userdelete);
router.get("/viewuser/:email", userController.viewuser);
router.patch("/rejectRecipe", isAuth, userController.rejectrecipe);
router.patch("/acceptrecipe", isAuth, userController.acceptrecipe);

module.exports = router;
