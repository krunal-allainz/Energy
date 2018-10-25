import api from './siteconfig'

export default { 
  getUserDetails(userData) {
  	return api.post('user/getDetails',{'userId':userData})
  },
  createUser(userData) {
      return api.post('user/create',{'userData':userData})
  },
  sendResetLinkInMail(requestData) {  
    return api.post('password/reset/link',{'email':requestData})
  },
  generateUserDetailsByType(type,status){
      return api.post('user/getUserDetailByUserType',{'type':type,'status':status});
  },
  generateUserNameById(consult_id) {
    return api.post('user/getUserNameById',{'id' :consult_id});
  },
  generateUserNameByIdForSignature(consult_id) {
    return api.post('user/getusernameforsignature',{'id' :consult_id});
  },
  getUserTypesList(){
    return api.post('user/types');
  },
  getImagefromUrl(url){
    return  api.post('user/getimagefromurl',{'url':url})
  },
  checkExistUser(type,value){
     return api.post('user/user_exist',{'type': type , value : value});
  },
  getAllUsersDetails(pageUrl,noOfPage){
     return api.post(pageUrl,{'noOfPage' :noOfPage });
  },
  deleteUserById(userId){
     return api.post('user/delete',{'userId' : userId});
  },
  getUserDetailByUserId(userId){
    return api.post('user/getUserDetailByUserId',{'userId' : userId});
  },
  editUser(userData,userId) {
    return api.post('user/edit',{'userData' : userData , 'userId' :userId})
  },
  
  
  //Hydro
  saveNomination(nominationData) {
    return api.post('nomination/create',{'nominationData':nominationData})
  },
}
