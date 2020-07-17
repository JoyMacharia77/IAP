const Sequelize = require('sequelize');
const models = require('../models');
const paginate = require('express-paginate')
const fs = require('fs');
const { STATUS_CODES } = require('http');

//Function to Add a New Student
async function addNewStudent(req,res,next)
{
    models.Student.create({
        student_name:req.body.student_name,
        course: req.body.course,
        adm_no: req.body.adm_no,
        email: req.body.email,
        phone_no: req.body.phone_no,
        gender: req.body.gender
    })
    .then((student)=>{
        res.status(201).json({
            message:'New Student Added Successfully',
            student:student
        })
    })
    .catch((error)=>{
        res.status(500).json({
            error:error.message
        })
    })
    
}

//To Return All Students
async function getAllStudents(req,res,next){
    models.Student.findAndCountAll({limit:req.query.limit, offset:req.skip})
    .then(results=>{
        const itemCount = results.count;
        const pageCount = Math.ceil(results.count/req.query.limit);
        return res.status(200).json({
            students:results.rows,
            pageCount,
            itemCount,
            pages:paginate.getArrayPages(req)(3,pageCount,req.query.page)
        })
    })
    .catch(err=>next(err))
}

//To return a specific student according to their ID
async function getOneStudent(req,res,next){
    const my_id = req.params.student_id;

    models.Student.findOne({where:{id:my_id}})
    .then((student)=>{
        return res.status(200).json({
            staus:200,
            student:student
        })
    })
    .catch((error)=>{
        return res.status(500).json({
            error:error.message
        })
    })
}

//To update details of a particular student
async function updateStudent(req,res){
    try {
        const my_id  = req.params.student_id;
        const [ updated ] = await models.Student.update(req.body, {
          where: { id: my_id }
        });
        if (updated) {
          const updatedStudent = await models.Student.findOne({ where: { id: my_id } });
          return res.status(200).json({ studentd: updatedStudent });
        }
        throw new Error('Specified Student does not exist');
      } 
      catch (error) {
        return res.status(500).send(error.message);
    }
}

//To Delete the Records of a Particular Student
async function deleteStudent(req,res){
    try {
        const my_id = req.params.student_id;
        const deleted = await models.Student.destroy({
          where: { id: my_id }
        });
        if (deleted) {
          return res.status(204).send("Student Deleted Successfully");
        }
        throw new Error("Specified Student does not exist");
    }
    catch (error) {
        return res.status(500).send(error.message);
    }
}


module.exports = 
{
    addNewStudent:addNewStudent,
    getAllStudents:getAllStudents,
    getOneStudent:getOneStudent,
    updateStudent:updateStudent,
    deleteStudent:deleteStudent
}