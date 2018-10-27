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
  
  getNominationList(page_url,userType,noofRecord,userId){
     return api.post(page_url,{'userType':userType,'noofRecord':noofRecord,'userId':userId});
  },
  getNominationListByDate(page_url,data){
     return api.post(page_url,{'nominationData':data});
  },
  
 createNomination(nominationData) {
      return api.post('nomination/create',{'nominationData':nominationData})
  },
  getNominationDetailsById(id) {
      return api.post('nomination/getNominationDetailsById',{'id':id})
  },
  editNomination(nominationData) {
      return api.post('nomination/edit',{'nominationData':nominationData})
  },
  deleteNomination(id) {
      return api.post('nomination/delete',{'id':id})
  },
  getTimelineData(userType,userId){
      return api.post('dashboard/gettimelinedata',{'userType' :userType,'userId' : userId});
  },
  getInvoiceList1(userId){
     return api.post('invoice/getInvoiceList1',{'userId':userId});
  },
  getInvoiceList2(userId){
     return api.post('invoice/getInvoiceList2',{'userId':userId});
  },
  updateSuppliedQuantity(){
      return api.post('schedule/updatesuppliedqty');
  },
  getNominationDetailsByDate(date){
     return api.post('nomination/getNominationDetailsByDate',{'date':date});
  },
  generateInvoice(){
    return api.post('invoice/generateinvoice');
  },
  createAvailability(){
     return api.post('availability/createAvailability');
  },
  getBuyerList(){
    return api.post('user/getbuyerlist');
  },
  getAvailability(){
    return api.post('availability/getAvailability');
  },
  getTotalApprovedQuantity(){
    return api.post('nomination/getTotalApprovedQuantity');
  },
  getTotalSuppliedQuantity(){
    return api.post('nomination/getTotalSuppliedQuantity');
  },
  getTotalRequestedQuantity(userId){
     return api.post('nomination/getTotalRequestedQuantity',{'userId':userId});
  },
  getTotalApprovedQuantityByBuyer(userId){
     return api.post('nomination/getTotalApprovedQuantityByBuyer',{'userId':userId});
  },
  getNominationCountForBuyer(userId){
     return api.post('nomination/getNominationCountForBuyer',{'userId':userId});
  },
   getAllowedQuantityByBuyerId(userId){
     return api.post('agreement/getAllowedQuantityByBuyerId',{'userId':userId});
  },
}
