DROP VIEW IF EXISTS manageAppointmentsView;
CREATE VIEW  manageAppointmentsView AS SELECT 

ma.id manageAppointmentsPrimaryId,
pt.id patientTablePrimaryId,
ct.id chamberTablePrimaryId,

ma.visitDate,
ma.visitTime,
ma.patientName,
ma.sex,
ma.contactNumber,
ma.email,
ma.status,
ma.smsStatus,

pt.patId patientGenId,
pt.fullName patientFullName,
pt.sex patientSex,
pt.age patientAge,
pt.contactNo patientContactNo,
pt.emgContactNo,
pt.email patientEmail,
pt.address patientAddress,
pt.district patientDistrict,
pt.diseaseName,
pt.consultationFees,
pt.doctorName patientDoctorName,
pt.otDate,
pt.lastVisitDate,
pt.remarks,
pt.filePath,
pt.imageName,

ct.chamberName,
ct.address chamberAddress,
ct.contactNo chamberContactNo,
ct.contactPersonName,
ct.contactPersonEmail,

dt.doctorName,
dt.consultationFees doctorConsultFees,
dt.contactNumber doctorContactNumber,
dt.email doctorEmail,
dt.status doctorStatus

FROM 
manageAppointments AS ma,
patientTable       AS pt,
chamberTable       AS ct,
doctorTable        AS dt 

WHERE ct.id = ma.chamberId
AND   dt.id = ma.doctorId
AND   pt.id = ma.patientId;
