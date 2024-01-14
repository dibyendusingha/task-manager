DROP VIEW IF EXISTS manageotinfoTableView;
CREATE VIEW  manageotinfoTableView AS SELECT 

ot.id manageotinfotablePrimaryId,
pt.id patientTablePrimaryId,
dt.id doctorTablePrimaryId,
nh.id nursinghomeTablePrimaryId,

ot.otName,
ot.insuranceCompanyName,
ot.otDate,
ot.otTime,
ot.admissionDate,
ot.admissionTime,
ot.bedType,
ot.anesthesiaReq,
ot.otFees,
ot.remarks,
ot.assDoctors,
ot.status,
ot.smsStatus,

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

pt.otDate patientOtDate,
pt.lastVisitDate,
pt.remarks patientRemarks,
pt.filePath,
pt.imageName,

nh.nursingHomeName,
nh.address nursingHomeAddress,
nh.contactNo nursingHomeContactNo,
nh.contactPersonName,
nh.contactPersonEmail,
nh.bedDetails,
nh.insuranceFacility,

dt.doctorName,
dt.consultationFees doctorConsultFees,
dt.contactNumber doctorContactNumber,
dt.email doctorEmail,
dt.status doctorStatus

FROM 
otInfoTable      AS ot,
patientTable     AS pt,
nursingHomeTable AS nh,
doctorTable      AS dt 

WHERE nh.id = ot.nursinghomeId
AND   dt.id = ot.doctorId
AND   pt.id = ot.patientId;