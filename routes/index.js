const express = require('express');
const router = express.Router();

const controller = require('../controller/studentController');


router.post('/addNewStudent',controller.addNewStudent);
router.get('/getOnestudent/:student_id',controller.getOneStudent);
router.get('/Getallstudents',controller.getAllStudents);
router.put('/updateStudent/:student_id',controller.updateStudent);
router.delete('/deleteStudent/:student_id',controller.deleteStudent);
module.exports = router;