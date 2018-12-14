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
  
  getNominationList(page_url,userType,noofRecord,userId,select_date){
     return api.post(page_url,{'userType':userType,'noofRecord':noofRecord,'userId':userId,'selectedDate':select_date});
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
  generateInvoiceByBuyerId(buyerId,sellerId,invoiceData,invoiceDataIndex,invoiceHtml,requestList,agreementData){
     return api.post('invoice/generateinvoicebybuyer', { 'buyerId' : buyerId, 'sellerId' : sellerId ,'invoiceData' : invoiceData , 'invoiceDataIndex' : invoiceDataIndex , 'invoiceHtml' : invoiceHtml , 'requestList' : requestList, 'agreementData' : agreementData});
  },
  generateInvoiceViewByBuyerId(buyerId){
    return api.post('invoice/viewbybuyer', { 'buyerId' : buyerId});
  },
  createAvailability(selected_date){
     return api.post('availability/createAvailability',{'selected_date':selected_date});
  },
  getBuyerRequestList(buyerId,requestType,typeInclude){
    return api.post('nomination/getbuyerrequestlist',{'buyerId' : buyerId,'requestType' : requestType,'typeInclude' : typeInclude});
  },
  getBuyerList(){
    return api.post('user/getbuyerlist');
  },
  getAvailability(selected_date){
    return api.post('availability/getAvailability',{'selected_date':selected_date});
  },
  getTotalRequestedQuantityForSeller(selected_date){
    return api.post('nomination/getTotalRequestedQuantityForSeller',{'selected_date':selected_date});
  },
  getTotalApprovedQuantity(selected_date){
    return api.post('nomination/getTotalApprovedQuantity',{'selected_date':selected_date});
  },
  getTotalSuppliedQuantity(selected_date){
    return api.post('nomination/getTotalSuppliedQuantity',{'selected_date':selected_date});
  },
  getTotalRequestedQuantity(selected_date,userId){
     return api.post('nomination/getTotalRequestedQuantity',{'selected_date':selected_date,'userId':userId});
  },
  getTotalApprovedQuantityByBuyer(selected_date,userId){
     return api.post('nomination/getTotalApprovedQuantityByBuyer',{'selected_date':selected_date,'userId':userId});
  },
  getTotalSuppliedQuantityByBuyer(selected_date,userId){
     return api.post('nomination/getTotalSuppliedQuantityByBuyer',{'selected_date':selected_date,'userId':userId});
  },
  getNominationDetailsByDateAndId(date,buyerId){
     return api.post('nomination/getNominationDetailsByDateById',{'date':date , 'buyerId' : buyerId});
  },
  getNominationCountForBuyer(userId,selected_date){
     return api.post('nomination/getNominationCountForBuyer',{'userId':userId,'selected_date':selected_date});
  },
  getAllowedQuantityByBuyerId(userId){
     return api.post('agreement/getAllowedQuantityByBuyerId',{'userId':userId});
  },
  getInvoiceDataByBuyerId(buyerId,noOfpage,pageUrl){
     return api.post(pageUrl,{'buyerId':buyerId ,'noOfpage' : noOfpage});
  },
  getInvoiceHtml(id){
     return api.post('invoice/invoiceView',{ 'id' : id });
  },
  checkAvaibilityForQuantityForApprove(nominationDate,nomnationId,nominationQty){
    return api.post('availability/getCheckAvaibilityForQuantity',{ 'currrentDate' : currrentDate ,'nominationDate':nominationDate,'nomnationId' : nomnationId,'nominationQty' : nominationQty});
  },
  addGcv(data) {
    return api.post('gcv/addGcv',{'data':data});

  },
  isGcvAdded(curDate) {
    return api.post('gcv/isAdded',{'curDate':curDate});
  },
  
  getNominationLngList(page_url,userType,noofRecord,userId,select_date){
     return api.post(page_url,{'userType':userType,'noofRecord':noofRecord,'userId':userId,'selectedDate':select_date});
  },
  getTruckDetailsList(data)
  {
      return api.post('truckDetails/getTruckDetailsList',data);
  },
  createNominationLng(nominationLngData)
  {
      return api.post('nominationLng/createNominationLng',{'nominationLngData':nominationLngData});
  },
  editNominationLng(nominationLngData)
  {
      return api.post('nominationLng/editNominationLng',{'nominationLngData':nominationLngData});
  },
  getNominationLngDetailsById(id) {
      return api.post('nominationLng/getNominationLngDetailsById',{'id':id})
  },
  deleteNominationLngById(id){
      return api.post('nominationLng/deleteNominationLngById',{'id':id});
  },
  approveQuatityForTruckLoad(data){
    return api.post('nominationLng/approve-nomination-lng-qty',{'data':data});
  },
  rejectQuatityForTruckLoad(data){
    return api.post('nominationLng/reject-nomination-lng-qty',{'data':data});
  }

}
