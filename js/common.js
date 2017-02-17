/**
 * Created by ShawnG on 2017/2/17.
 */

/**
 *  跳转到病人详情页面
 * @param id
 */
function showPatientDetail(id) {
    window.location = "patientDetail.php?res_id=" + id;
}

/**
 *  跳转到病人病例页面
 * @param id
 */
function showPatientCases(id) {
    window.location = "patientCases.php?user_id=" + id;
}

/**
 *  显示病例详情
 * @param id
 */
function showCaseDetail(id) {
    var detailTable = document.getElementById(id);
    detailTable.style.display = "";
    detailTable.style.height = document.body.clientHeight + "px";
    detailTable.style.width = document.body.clientWidth + "px";
}

/**
 *  隐藏病例详情
 * @param id
 */
function hideCaseDetail(id) {
    var detailTable = document.getElementById(id);
    detailTable.style.display = "none";
}

/**
 * 跳转到创建病人病例页面
 * @param id
 */
function createPatientCase(id) {
    window.location = "createPatientCase.php?res_id=" + id;
}

/**
 *  跳转到修改密码页面
 * @param id
 */
function changePassword(id) {
    window.location = "changePassPage.php?hos_id=" + id;
}