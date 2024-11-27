$(document).ready(function () {
  $(".type_" + CANCER_TYPE).removeClass("to_remove");
  $(".to_remove").remove();

  console.log(CANCER_TYPE);

  let colors = {
      None: "#001B29",
      Mild: "#27AE60",
      Moderate: "#FF9409",
      Severe: "#EB5757",
      Other: "#8d2d90",
      _empty: "#ced4da",
    },
    ACTIVE_SIDE_EFFECT_ID = "",
    SELECTED_DATE = "",
    TODAY = new Date();

  $(".tab_item").on("click", function () {
    let t = $(this),
      tab = t.attr("data-tab");

    if (!tab) return;

    $(".tab_item").removeClass("active");
    t.addClass("active");

    $(".tab_container").hide();
    $(".tab_container." + tab).show();
  });

  $(".feeling_item").on("click", function () {
    $(".feeling_item").removeClass("active");
    $(this).addClass("active");
  });

  $(".report_side_effect,.start_log").on("click", function () {
    if (!SELECTED_DATE) {
      $(".ui-datepicker-today").click();
    }

    $(".snt").text("Log a side effect");
    $(".go_back").removeClass("d-none");
    $('.tab_item[data-tab="side_effects"]').click();
    $(
      ".side_effects_graph,.tab_holder,.right_actions,.edit_side_effects"
    ).addClass("d-none");
    $(".feelings,.severity_text").removeClass("d-none");
    $(".empty_state").hide();
    $(".side_effect_items").show();
    $(".sub-state").text("How are you feeling today?");
    $(".extender").addClass("as_dropdown");
    $(".drop_d").css("background", "#f9f9f9");
    $(".i-g-block-label").css("padding-bottom", "0");
  });

  $(".log_a_treatment").on("click", function () {
    $(".go_back").removeClass("d-none");
    $(".tab_holder").addClass("d-none");
    $(".right_actions").addClass("d-none");
    $(".snt").text("Log a treatment");
    $(".treatment_item").css("flex", "auto");
    $('.tab_item[data-tab="treatments"]').click();
  });

  $(".go_back").on("click", function () {
    $(".snt").text("Side Effects");
    $(".go_back").addClass("d-none");
    $(
      ".side_effects_graph,.tab_holder,.right_actions,.edit_side_effects"
    ).removeClass("d-none");
    $(".feelings,.severity_text").addClass("d-none");
    $(".empty_state").show();
    $(".side_effect_items").hide();
    $(".sub-state,.es_message").text("Click on a day to begin");
    $(".extender").removeClass("as_dropdown");
    $(".drop_d").css("background", "#fff");
    $(".i-g-block-label").removeAttr("style");
    $(".treatment_item").css("flex", "1");
  });

  $(".treatment_item").on("click", function () {
    $(".treatment_frame").attr("src", `${$(this).attr("data-frame")}`);
    $(".treament_modal_title").text($(this).text());
    $(".treament_modal").fadeIn();
  });

  $(".close_treament_modal").on("click", function () {
    $(".treatment_frame").attr("src", "");
    $(".treament_modal").fadeOut();
  });

  $("#datepicker").datepicker({
    dayNamesMin: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
    maxDate: TODAY,
  });

  $("#datepicker").datepicker("option", "changeMonth", true);
  $("#datepicker").datepicker("option", "changeYear", true);
  $("#datepicker").datepicker("option", "dateFormat", "d M, yy");
  $("#datepicker").datepicker("option", "showAnim", "");

  afterData();

  $(".sfx_select").change(function () {
    let t = $(this),
      v = t.val();
    t.siblings(".simple_flex").hide();
    if (v != "") {
      if (v == "None") {
        changeColor(t, colors.None);
      } else if (v == "Mild") {
        changeColor(t, colors.Mild);
      } else if (v == "Moderate") {
        changeColor(t, colors.Moderate);
      } else if (v == "Severe") {
        changeColor(t, colors.Severe);
      } else if (v == "other") {
        changeColor(t, colors.Other);
        t.siblings(".simple_flex").show();
      }
    } else {
      changeColor(t, colors._empty);
    }
  });

  $("input")
    .keyup(function () {
      inputChange($(this));
    })
    .focus(function () {
      inputChange($(this));
    })
    .blur(function () {
      inputChange($(this));
    });

  function inputChange(elem) {
    if (elem.val() != "") {
      changeColor(elem, colors.Other);
    } else {
      changeColor(elem, colors.None);
    }
  }

  function changeColor(elem, color) {
    if (color == colors._empty) return;
    elem.css({
      "border-color": color,
      background: color,
      color: "#fff",
      // 'background': color+'0f'
    });
  }

  loadData();

  if (window.location.href.indexOf("#Create") > -1) {
    $("#addModal").modal("show");
  }

  $("#add-data").on("click", function () {
    let feeling = $(".feeling_item.active span").text(),
      treatment_type = $("#treatment_type").val();

    // if(date_elem.length < 1){
    if (!SELECTED_DATE) {
      error("Select a date first", "");
      return;
    }

    if (feeling == "") {
      error("Select a severity first", "");
      return;
    }

    if (!treatment_type || treatment_type == "") {
      error("Select a treatment type", "");
      return;
    }

    if (CANCER_TYPE == "breast") {
      var b_hair_loss = $("#b_hair_loss").val(),
        b_arm_swelling = $("#b_arm_swelling").val(),
        b_swallowing_difficulty = $("#b_swallowing_difficulty").val(),
        b_chest_pain = $("#b_chest_pain").val(),
        b_breast_swelling =
          $("#b_breast_swelling").val() == "other"
            ? $("#b_breast_swelling_other").val()
            : $("#b_breast_swelling").val(),
        b_breast_pain = $("#b_breast_pain").val(),
        b_sensation_loss = $("#b_sensation_loss").val(),
        b_skin_color = $("#b_skin_color").val(),
        b_tired_or_weak = $("#b_tired_or_weak").val(),
        b_weight = $("#b_weight").val(),
        b_hb = $("#b_hb").val(),
        b_pcv = $("#b_pcv").val(),
        b_anc = $("#b_anc").val(),
        b_platelet = $("#b_platelet").val(),
        b_note = $("#b_note").val(),
        b_wbc = $("#b_wbc").val();

      /*
            if (b_hair_loss == '' || b_hair_loss == null) {
                error('Provide severity of hair loss', $('#b_hair_loss'))
                return
            } else if (b_arm_swelling == '' || b_arm_swelling == null) {
                error('Provide severity of arm swelling', $('#b_arm_swelling'))
                return
            } else if (b_swallowing_difficulty == '' || b_swallowing_difficulty == null) {
                error('Provide severity of swallowing difficulty', $('#b_swallowing_difficulty'))
                return
            } else if (b_chest_pain == '' || b_chest_pain == null) {
                error('Provide severity of chest pain', $('#b_chest_pain'))
                return
            } else if (b_breast_swelling == '' || b_breast_swelling == null) {
                error('Provide severity of breast swelling', $('#b_breast_swelling'))
                return
            } else if (b_breast_pain == '' || b_breast_pain == null) {
                error('Provide severity of breast pain', $('#b_breast_pain'))
                return
            } else if (b_sensation_loss == '' || b_sensation_loss == null) {
                error('Provide severity of arm sensation loss', $('#b_sensation_loss'))
                return
            } else if (b_skin_color == '' || b_skin_color == null) {
                error('Provide severity of skin color changes', $('#b_skin_color'))
                return
            } else if (b_tired_or_weak == '' || b_tired_or_weak == null) {
                error('Provide severity of tiredness/weakness', $('#b_tired_or_weak'))
                return
            }
            */

      Swal.fire({
        title: "Logging Side Effects",
        allowOutsideClick: false,
        onBeforeOpen: function () {
          Swal.showLoading();
        },
      });

      $("#addModal,#editModal").modal("hide");

      var formData = [
        b_hair_loss,
        b_arm_swelling,
        b_swallowing_difficulty,
        b_chest_pain,
        b_breast_swelling,
        b_breast_pain,
        b_sensation_loss,
        b_skin_color,
        b_tired_or_weak,
        b_weight,
        b_hb,
        b_pcv,
        b_anc,
        b_platelet,
        b_note,
        b_wbc,
        SELECTED_DATE,
        treatment_type,
        feeling,
      ];

      $.ajax({
        async: false,
        url: "./API/api_side_effects_create_breast.php",
        data: { data: formData },
        type: "POST",
        success: function (data) {
          if (data == "1") {
            log("Logged Side Effects", "New Log");
            s("Side Effects Logged");
          } else {
            console.log(data);
            e(data);
          }
        },
        fail: function (data) {
          e(data);
        },
        error: function (data) {
          e(data);
        },
      });
    } else if (CANCER_TYPE == "head_and_neck") {
      var hn_mouth_sore = $("#hn_mouth_sore").val(),
        hn_diff_in_swallowing = $("#hn_diff_in_swallowing").val(),
        hn_loss_of_smell =
          $("#hn_loss_of_smell").val() == "other"
            ? $("#hn_loss_of_smell_other").val()
            : $("#hn_loss_of_smell").val(),
        hn_taste_changes = $("#hn_taste_changes").val(),
        hn_dry_mouth = $("#hn_dry_mouth").val(),
        hn_mouth_cracking =
          $("#hn_mouth_cracking").val() == "other"
            ? $("#hn_mouth_cracking_other").val()
            : $("#hn_mouth_cracking").val(),
        hn_voice_change = $("#hn_voice_change").val(),
        hn_appetite_changes = $("#hn_appetite_changes").val(),
        hn_nausea =
          $("#hn_nausea").val() == "other"
            ? $("#hn_nausea_other").val()
            : $("#hn_nausea").val(),
        hn_vomiting = $("#hn_vomiting").val(),
        hn_skin_color_changes = $("#hn_skin_color_changes").val(),
        hn_tired_or_weak = $("#hn_tired_or_weak").val(),
        hn_weight = $("#hn_weight").val(),
        hn_note = $("#hn_note").val(),
        hn_on_chemo = $("#hn_on_chemo").val();

      /*
            if (hn_mouth_sore == '' || hn_mouth_sore == null) {
                error('Provide severity of mouth sore', $('#hn_mouth_sore'))
                return
            } else if (hn_diff_in_swallowing == '' || hn_diff_in_swallowing == null) {
                error('Provide severity of difficulty in swallowing', $('#hn_diff_in_swallowing'))
                return
            } else if (hn_loss_of_smell == '' || hn_loss_of_smell == null) {
                error('Provide severity of smell loss', $('#hn_loss_of_smell'))
                return
            } else if (hn_taste_changes == '' || hn_taste_changes == null) {
                error('Provide severity of taste changes', $('#hn_taste_changes'))
                return
            } else if (hn_dry_mouth == '' || hn_dry_mouth == null) {
                error('Provide severity of dry mouth', $('#hn_dry_mouth'))
                return
            } else if (hn_mouth_cracking == '' || hn_mouth_cracking == null) {
                error('Provide severity of mouth cracking', $('#hn_mouth_cracking'))
                return
            } else if (hn_voice_change == '' || hn_voice_change == null) {
                error('Provide severity of voice change', $('#hn_voice_change'))
                return
            } else if (hn_appetite_changes == '' || hn_appetite_changes == null) {
                error('Provide severity of appetite loss', $('#hn_appetite_changes'))
                return
            } else if (hn_nausea == '' || hn_nausea == null) {
                error('Provide severity of nausea', $('#hn_nausea'))
                return
            } else if (hn_vomiting == '' || hn_vomiting == null) {
                error('Provide severity of vomiting', $('#hn_vomiting'))
                return
            } else if (hn_skin_color_changes == '' || hn_skin_color_changes == null) {
                error('Provide severity of skin color changes', $('#hn_skin_color_changes'))
                return
            } else if (hn_tired_or_weak == '' || hn_tired_or_weak == null) {
                error('Provide severity of tiredness', $('#hn_tired_or_weak'))
                return
            } else if (hn_on_chemo == '' || hn_on_chemo == null) {
                error('Provide a response for chemotherapy', $('#hn_on_chemo'))
                return
            }
            */

      Swal.fire({
        title: "Logging Side Effects",
        allowOutsideClick: false,
        onBeforeOpen: function () {
          Swal.showLoading();
        },
      });

      $("#addModal,#editModal").modal("hide");

      var formData = [
        hn_mouth_sore,
        hn_diff_in_swallowing,
        hn_loss_of_smell,
        hn_taste_changes,
        hn_dry_mouth,
        hn_mouth_cracking,
        hn_voice_change,
        hn_appetite_changes,
        hn_nausea,
        hn_vomiting,
        hn_skin_color_changes,
        hn_tired_or_weak,
        hn_weight,
        hn_note,
        hn_on_chemo,
        SELECTED_DATE,
        treatment_type,
        feeling,
      ];

      $.ajax({
        async: false,
        url: "./API/api_side_effects_create_head_and_neck.php",
        data: { data: formData },
        type: "POST",
        success: function (data) {
          if (data == "1") {
            log("Logged Side Effects", "New Log");
            s("Side Effects Logged");
          } else {
            console.log(data);
            e(data);
          }
        },
        fail: function (data) {
          e(data);
        },
        error: function (data) {
          e(data);
        },
      });
    } else if (CANCER_TYPE == "female_pelvic") {
      var fp_loose_stool = $("#fp_loose_stool").val(),
        fp_nausea =
          $("#fp_nausea").val() == "other"
            ? $("#fp_nausea_other").val()
            : $("#fp_nausea").val(),
        fp_vomiting = $("#fp_vomiting").val(),
        fp_skin_color = $("#fp_skin_color").val(),
        fp_anus_changes = $("#fp_anus_changes").val(),
        fp_blood_in_urine = $("#fp_blood_in_urine").val(),
        fp_diff_urinating = $("#fp_diff_urinating").val(),
        fp_painful_urine = $("#fp_painful_urine").val(),
        fp_feel_like_urine = $("#fp_feel_like_urine").val(),
        fp_urine_control = $("#fp_urine_control").val(),
        fp_urine_rate = $("#fp_urine_rate").val(),
        fp_vag_dry = $("#fp_vag_dry").val(),
        fp_stool_leak = $("#fp_stool_leak").val(),
        fp_tired_or_weak = $("#fp_tired_or_weak").val(),
        fp_weight = $("#fp_weight").val(),
        fp_note = $("#fp_note").val(),
        fp_on_chemo = $("#fp_on_chemo").val();

      /*
            if (fp_loose_stool == '' || fp_loose_stool == null) {
                error('Provide severity of loose stools', $('#fp_loose_stool'))
                return
            } else if (fp_nausea == '' || fp_nausea == null) {
                error('Provide severity of nausea', $('#fp_nausea'))
                return
            } else if (fp_vomiting == '' || fp_vomiting == null) {
                error('Provide severity of vomiting', $('#fp_vomiting'))
                return
            } else if (fp_skin_color == '' || fp_skin_color == null) {
                error('Provide severity of skin color changes', $('#fp_skin_color'))
                return
            } else if (fp_anus_changes == '' || fp_anus_changes == null) {
                error('Provide severity of anus changes', $('#fp_anus_changes'))
                return
            } else if (fp_blood_in_urine == '' || fp_blood_in_urine == null) {
                error('Provide severity of blood in urine', $('#fp_blood_in_urine'))
                return
            } else if (fp_diff_urinating == '' || fp_diff_urinating == null) {
                error('Provide severity of difficulty in urinating', $('#fp_diff_urinating'))
                return
            } else if (fp_painful_urine == '' || fp_painful_urine == null) {
                error('Provide severity of painful urination', $('#fp_painful_urine'))
                return
            } else if (fp_feel_like_urine == '' || fp_feel_like_urine == null) {
                error('Provide severity of urination frequency', $('#fp_feel_like_urine'))
                return
            } else if (fp_urine_control == '' || fp_urine_control == null) {
                error('Provide severity of urine flow control', $('#fp_urine_control'))
                return
            } else if (fp_urine_rate == '' || fp_urine_rate == null) {
                error('Provide severity of urination rate', $('#fp_urine_rate'))
                return
            } else if (fp_vag_dry == '' || fp_vag_dry == null) {
                error('Provide severity of vaginal dryness', $('#fp_vag_dry'))
                return
            }else if (fp_stool_leak == '' || fp_stool_leak == null) {
                error('Provide severity of stool leakage', $('#fp_stool_leak'))
                return
            }else if (fp_tired_or_weak == '' || fp_tired_or_weak == null) {
                error('Provide severity of tiredness / weakness', $('#fp_tired_or_weak'))
                return
            } else if (fp_on_chemo == '' || fp_on_chemo == null) {
                error('Provide a response for chemotherapy', $('#fp_on_chemo'))
                return
            }
            */

      Swal.fire({
        title: "Logging Side Effects",
        allowOutsideClick: false,
        onBeforeOpen: function () {
          Swal.showLoading();
        },
      });

      $("#addModal,#editModal").modal("hide");

      var formData = [
        fp_loose_stool,
        fp_nausea,
        fp_vomiting,
        fp_skin_color,
        fp_anus_changes,
        fp_blood_in_urine,
        fp_diff_urinating,
        fp_painful_urine,
        fp_feel_like_urine,
        fp_urine_control,
        fp_urine_rate,
        fp_vag_dry,
        fp_stool_leak,
        fp_tired_or_weak,
        fp_weight,
        fp_note,
        fp_on_chemo,
        SELECTED_DATE,
        treatment_type,
        feeling,
      ];

      $.ajax({
        async: false,
        url: "./API/api_side_effects_create_female_pelvic.php",
        data: { data: formData },
        type: "POST",
        success: function (data) {
          if (data == "1") {
            log("Logged Side Effects", "New Log");
            s("Side Effects Logged");
          } else {
            console.log(data);
            e(data);
          }
        },
        fail: function (data) {
          e(data);
        },
        error: function (data) {
          e(data);
        },
      });
    } else if (CANCER_TYPE == "male_pelvic") {
      var mp_blood_in_urine = $("#mp_blood_in_urine").val(),
        mp_diff_urinating = $("#mp_diff_urinating").val(),
        mp_painful_urine = $("#mp_painful_urine").val(),
        mp_urine_rate = $("#mp_urine_rate").val(),
        mp_feel_like_urine = $("#mp_feel_like_urine").val(),
        mp_urine_control = $("#mp_urine_control").val(),
        mp_nausea =
          $("#mp_nausea").val() == "other"
            ? $("#mp_nausea_other").val()
            : $("#mp_nausea").val(),
        mp_vomiting = $("#mp_vomiting").val(),
        mp_loose_stool = $("#mp_loose_stool").val(),
        mp_anus_changes = $("#mp_anus_changes").val(),
        mp_blood_from_anus = $("#mp_blood_from_anus").val(),
        mp_diff_stooling = $("#mp_diff_stooling").val(),
        mp_belly_tight =
          $("#mp_belly_tight").val() == "other"
            ? $("#mp_belly_tight_other").val()
            : $("#mp_belly_tight").val(),
        mp_stool_leak = $("#mp_stool_leak").val(),
        mp_erection =
          $("#mp_erection").val() == "other"
            ? $("#mp_erection_other").val()
            : $("#mp_erection").val(),
        mp_diff_in_releases =
          $("#mp_diff_in_releases").val() == "other"
            ? $("#mp_diff_in_releases_other").val()
            : $("#mp_diff_in_releases").val(),
        mp_decreased_desire =
          $("#mp_decreased_desire").val() == "other"
            ? $("#mp_decreased_desire_other").val()
            : $("#mp_decreased_desire").val(),
        mp_painful_sex =
          $("#mp_painful_sex").val() == "other"
            ? $("#mp_painful_sex_other").val()
            : $("#mp_painful_sex").val(),
        mp_tired_or_weak = $("#mp_tired_or_weak").val(),
        mp_weight = $("#mp_weight").val(),
        mp_note = $("#mp_note").val(),
        mp_on_chemo = $("#mp_on_chemo").val();

      /*
            if (mp_blood_in_urine == '' || mp_blood_in_urine == null) {
                error('Provide severity of blood in urine', $('#mp_blood_in_urine'))
                return
            } else if (mp_diff_urinating == '' || mp_diff_urinating == null) {
                error('Provide severity of difficulty in urinating', $('#mp_diff_urinating'))
                return
            } else if (mp_painful_urine == '' || mp_painful_urine == null) {
                error('Provide severity of painful urination', $('#mp_painful_urine'))
                return
            } else if (mp_urine_rate == '' || mp_urine_rate == null) {
                error('Provide rate of urination', $('#mp_urine_rate'))
                return
            } else if (mp_feel_like_urine == '' || mp_feel_like_urine == null) {
                error('Provide severity of skin color changes', $('#mp_feel_like_urine'))
                return
            } else if (mp_urine_control == '' || mp_urine_control == null) {
                error('Provide severity of urine control', $('#mp_urine_control'))
                return
            } else if (mp_nausea == '' || mp_nausea == null) {
                error('Provide a severity of nausea', $('#mp_nausea'))
                return
            } else if (mp_vomiting == '' || mp_vomiting == null) {
                error('Provide a severity of vomiting', $('#mp_vomiting'))
                return
            } else if (mp_loose_stool == '' || mp_loose_stool == null) {
                error('Provide a severity of loose stools', $('#mp_loose_stool'))
                return
            } else if (mp_anus_changes == '' || mp_anus_changes == null) {
                error('Provide a severity of anus changes', $('#mp_anus_changes'))
                return
            } else if (mp_blood_from_anus == '' || mp_blood_from_anus == null) {
                error('Provide a severity of blood from anus', $('#mp_blood_from_anus'))
                return
            } else if (mp_diff_stooling == '' || mp_diff_stooling == null) {
                error('Provide a severity of stooling difficulty', $('#mp_diff_stooling'))
                return
            } else if (mp_belly_tight == '' || mp_belly_tight == null) {
                error('Provide a severity of belly tightness', $('#mp_belly_tight'))
                return
            } else if (mp_stool_leak == '' || mp_stool_leak == null) {
                error('Provide a severity of stool leakage', $('#mp_stool_leak'))
                return
            } else if (mp_erection == '' || mp_erection == null) {
                error('Provide a severity of erection maintenance', $('#mp_erection'))
                return
            } else if (mp_diff_in_releases == '' || mp_diff_in_releases == null) {
                error('Provide a severity of difficulty in releasing sperm', $('#mp_diff_in_releases'))
                return
            } else if (mp_decreased_desire == '' || mp_decreased_desire == null) {
                error('Provide a severity of decreased sexual desire', $('#mp_decreased_desire'))
                return
            } else if (mp_painful_sex == '' || mp_painful_sex == null) {
                error('Provide a severity of painful sex', $('#mp_painful_sex'))
                return
            } else if (mp_tired_or_weak == '' || mp_tired_or_weak == null) {
                error('Provide a severity of tiredness', $('#mp_tired_or_weak'))
                return
            } else if (mp_on_chemo == '' || mp_on_chemo == null) {
                error('Provide an option for chemotherapy', $('#mp_on_chemo'))
                return
            } 
            */

      Swal.fire({
        title: "Logging Side Effects",
        allowOutsideClick: false,
        onBeforeOpen: function () {
          Swal.showLoading();
        },
      });

      $("#addModal,#editModal").modal("hide");

      var formData = [
        mp_blood_in_urine,
        mp_diff_urinating,
        mp_painful_urine,
        mp_urine_rate,
        mp_feel_like_urine,
        mp_urine_control,
        mp_nausea,
        mp_vomiting,
        mp_loose_stool,
        mp_anus_changes,
        mp_blood_from_anus,
        mp_diff_stooling,
        mp_belly_tight,
        mp_stool_leak,
        mp_erection,
        mp_diff_in_releases,
        mp_decreased_desire,
        mp_painful_sex,
        mp_tired_or_weak,
        mp_weight,
        mp_note,
        mp_on_chemo,
        SELECTED_DATE,
        treatment_type,
        feeling,
      ];

      $.ajax({
        async: false,
        url: "./API/api_side_effects_create_male_pelvic.php",
        data: { data: formData },
        type: "POST",
        success: function (data) {
          if (data == "1") {
            log("Logged Side Effects", "New Log");
            s("Side Effects Logged");
          } else {
            console.log(data);
            e(data);
          }
        },
        fail: function (data) {
          e(data);
        },
        error: function (data) {
          e(data);
        },
      });
    }
  });

  $("#update-data").on("click", function () {
    let treatment_type = $("#treatment_type").val();

    // if(date_elem.length < 1 || ACTIVE_SIDE_EFFECT_ID == ''){
    if (!SELECTED_DATE || ACTIVE_SIDE_EFFECT_ID == "") {
      error("Select a date first", "");
      return;
    }

    if (!treatment_type || treatment_type == "") {
      error("Select a treatment type", "");
      return;
    }

    if (CANCER_TYPE == "breast") {
      var b_hair_loss = $("#b_hair_loss").val(),
        b_arm_swelling = $("#b_arm_swelling").val(),
        b_swallowing_difficulty = $("#b_swallowing_difficulty").val(),
        b_chest_pain = $("#b_chest_pain").val(),
        b_breast_swelling =
          $("#b_breast_swelling").val() == "other"
            ? $("#b_breast_swelling_other").val()
            : $("#b_breast_swelling").val(),
        b_breast_pain = $("#b_breast_pain").val(),
        b_sensation_loss = $("#b_sensation_loss").val(),
        b_skin_color = $("#b_skin_color").val(),
        b_tired_or_weak = $("#b_tired_or_weak").val(),
        b_weight = $("#b_weight").val(),
        b_hb = $("#b_hb").val(),
        b_pcv = $("#b_pcv").val(),
        b_anc = $("#b_anc").val(),
        b_platelet = $("#b_platelet").val(),
        b_note = $("#b_note").val(),
        b_wbc = $("#b_wbc").val();

      /*
            if (b_hair_loss == '' || b_hair_loss == null) {
                error('Provide severity of hair loss', $('#b_hair_loss'))
                return
            } else if (b_arm_swelling == '' || b_arm_swelling == null) {
                error('Provide severity of arm swelling', $('#b_arm_swelling'))
                return
            } else if (b_swallowing_difficulty == '' || b_swallowing_difficulty == null) {
                error('Provide severity of swallowing difficulty', $('#b_swallowing_difficulty'))
                return
            } else if (b_sensation_loss == '' || b_sensation_loss == null) {
                error('Provide severity of arm sensation loss', $('#b_sensation_loss'))
                return
            } else if (b_skin_color == '' || b_skin_color == null) {
                error('Provide severity of skin color changes', $('#b_skin_color'))
                return
            } else if (b_tired_or_weak == '' || b_tired_or_weak == null) {
                error('Provide severity of tiredness/weakness', $('#b_tired_or_weak'))
                return
            } 
            */

      // else if (b_weight == '' || b_weight == null) {
      //     error('Provide your weight', $('#b_weight'))
      //     return
      // }
      // else if (b_hb == '' || b_hb == null) {
      //     error('Provide Hb parameter', $('#b_hb'))
      //     return
      // } else if (b_pcv == '' || b_pcv == null) {
      //     error('Provide PCV parameter', $('#b_pcv'))
      //     return
      // } else if (b_anc == '' || b_anc == null) {
      //     error('Provide ANC parameter', $('#b_anc'))
      //     return
      // } else if (b_platelet == '' || b_platelet == null) {
      //     error('Provide Platelet parameter', $('#b_platelet'))
      //     return
      // } else if (b_wbc == '' || b_wbc == null) {
      //     error('Provide WBC parameter', $('#b_wbc'))
      //     return
      // }

      Swal.fire({
        title: "Updating Side Effects",
        allowOutsideClick: false,
        onBeforeOpen: function () {
          Swal.showLoading();
        },
      });

      $("#addModal,#editModal").modal("hide");

      var formData = [
        b_hair_loss,
        b_arm_swelling,
        b_swallowing_difficulty,
        b_chest_pain,
        b_breast_swelling,
        b_breast_pain,
        b_sensation_loss,
        b_skin_color,
        b_tired_or_weak,
        b_weight,
        b_hb,
        b_pcv,
        b_anc,
        b_platelet,
        b_note,
        b_wbc,
        SELECTED_DATE,
        ACTIVE_SIDE_EFFECT_ID,
        treatment_type,
      ];

      $.ajax({
        async: false,
        url: "./API/api_side_effects_update_breast.php",
        data: { data: formData },
        type: "POST",
        success: function (data) {
          if (data == "1") {
            log("Updated a Side Effect Log", "Update");
            s("Side Effects Updated");
          } else {
            console.log(data);
            e(data);
          }
        },
        fail: function (data) {
          e(data);
        },
        error: function (data) {
          e(data);
        },
      });
    } else if (CANCER_TYPE == "head_and_neck") {
      var hn_mouth_sore = $("#hn_mouth_sore").val(),
        hn_diff_in_swallowing = $("#hn_diff_in_swallowing").val(),
        hn_loss_of_smell =
          $("#hn_loss_of_smell").val() == "other"
            ? $("#hn_loss_of_smell_other").val()
            : $("#hn_loss_of_smell").val(),
        hn_taste_changes = $("#hn_taste_changes").val(),
        hn_dry_mouth = $("#hn_dry_mouth").val(),
        hn_mouth_cracking =
          $("#hn_mouth_cracking").val() == "other"
            ? $("#hn_mouth_cracking_other").val()
            : $("#hn_mouth_cracking").val(),
        hn_voice_change = $("#hn_voice_change").val(),
        hn_appetite_changes = $("#hn_appetite_changes").val(),
        hn_nausea =
          $("#hn_nausea").val() == "other"
            ? $("#hn_nausea_other").val()
            : $("#hn_nausea").val(),
        hn_vomiting = $("#hn_vomiting").val(),
        hn_skin_color_changes = $("#hn_skin_color_changes").val(),
        hn_tired_or_weak = $("#hn_tired_or_weak").val(),
        hn_weight = $("#hn_weight").val(),
        hn_note = $("#hn_note").val(),
        hn_on_chemo = $("#hn_on_chemo").val();

      /*
            if (hn_mouth_sore == '' || hn_mouth_sore == null) {
                error('Provide severity of mouth sore', $('#hn_mouth_sore'))
                return
            } else if (hn_diff_in_swallowing == '' || hn_diff_in_swallowing == null) {
                error('Provide severity of difficulty in swallowing', $('#hn_diff_in_swallowing'))
                return
            } else if (hn_loss_of_smell == '' || hn_loss_of_smell == null) {
                error('Provide severity of smell loss', $('#hn_loss_of_smell'))
                return
            } else if (hn_taste_changes == '' || hn_taste_changes == null) {
                error('Provide severity of taste changes', $('#hn_taste_changes'))
                return
            } else if (hn_dry_mouth == '' || hn_dry_mouth == null) {
                error('Provide severity of dry mouth', $('#hn_dry_mouth'))
                return
            } else if (hn_mouth_cracking == '' || hn_mouth_cracking == null) {
                error('Provide severity of mouth cracking', $('#hn_mouth_cracking'))
                return
            } else if (hn_voice_change == '' || hn_voice_change == null) {
                error('Provide severity of voice change', $('#hn_voice_change'))
                return
            } else if (hn_appetite_changes == '' || hn_appetite_changes == null) {
                error('Provide severity of appetite loss', $('#hn_appetite_changes'))
                return
            } else if (hn_nausea == '' || hn_nausea == null) {
                error('Provide severity of nausea', $('#hn_nausea'))
                return
            } else if (hn_vomiting == '' || hn_vomiting == null) {
                error('Provide severity of vomiting', $('#hn_vomiting'))
                return
            } else if (hn_skin_color_changes == '' || hn_skin_color_changes == null) {
                error('Provide severity of skin color changes', $('#hn_skin_color_changes'))
                return
            } else if (hn_tired_or_weak == '' || hn_tired_or_weak == null) {
                error('Provide severity of tiredness', $('#hn_tired_or_weak'))
                return
            } else if (hn_on_chemo == '' || hn_on_chemo == null) {
                error('Provide a response for chemotherapy', $('#hn_on_chemo'))
                return
            }
            */

      Swal.fire({
        title: "Updating Side Effects",
        allowOutsideClick: false,
        onBeforeOpen: function () {
          Swal.showLoading();
        },
      });

      $("#addModal,#editModal").modal("hide");

      var formData = [
        hn_mouth_sore,
        hn_diff_in_swallowing,
        hn_loss_of_smell,
        hn_taste_changes,
        hn_dry_mouth,
        hn_mouth_cracking,
        hn_voice_change,
        hn_appetite_changes,
        hn_nausea,
        hn_vomiting,
        hn_skin_color_changes,
        hn_tired_or_weak,
        hn_weight,
        hn_note,
        hn_on_chemo,
        SELECTED_DATE,
        ACTIVE_SIDE_EFFECT_ID,
        treatment_type,
      ];

      $.ajax({
        async: false,
        url: "./API/api_side_effects_update_head_and_neck.php",
        data: { data: formData },
        type: "POST",
        success: function (data) {
          if (data == "1") {
            log("Updated a Side Effect Log", "Update");
            s("Side Effects Updated");
          } else {
            console.log(data);
            e(data);
          }
        },
        fail: function (data) {
          e(data);
        },
        error: function (data) {
          e(data);
        },
      });
    } else if (CANCER_TYPE == "female_pelvic") {
      var fp_loose_stool = $("#fp_loose_stool").val(),
        fp_nausea =
          $("#fp_nausea").val() == "other"
            ? $("#fp_nausea_other").val()
            : $("#fp_nausea").val(),
        fp_vomiting = $("#fp_vomiting").val(),
        fp_skin_color = $("#fp_skin_color").val(),
        fp_anus_changes = $("#fp_anus_changes").val(),
        fp_blood_in_urine = $("#fp_blood_in_urine").val(),
        fp_diff_urinating = $("#fp_diff_urinating").val(),
        fp_painful_urine = $("#fp_painful_urine").val(),
        fp_feel_like_urine = $("#fp_feel_like_urine").val(),
        fp_urine_control = $("#fp_urine_control").val(),
        fp_urine_rate = $("#fp_urine_rate").val(),
        fp_vag_dry = $("#fp_vag_dry").val(),
        fp_stool_leak = $("#fp_stool_leak").val(),
        fp_tired_or_weak = $("#fp_tired_or_weak").val(),
        fp_weight = $("#fp_weight").val(),
        fp_note = $("#fp_note").val(),
        fp_on_chemo = $("#fp_on_chemo").val();

      /*
            if (fp_loose_stool == '' || fp_loose_stool == null) {
                error('Provide severity of loose stools', $('#fp_loose_stool'))
                return
            } else if (fp_nausea == '' || fp_nausea == null) {
                error('Provide severity of nausea', $('#fp_nausea'))
                return
            } else if (fp_vomiting == '' || fp_vomiting == null) {
                error('Provide severity of vomiting', $('#fp_vomiting'))
                return
            } else if (fp_skin_color == '' || fp_skin_color == null) {
                error('Provide severity of skin color changes', $('#fp_skin_color'))
                return
            } else if (fp_anus_changes == '' || fp_anus_changes == null) {
                error('Provide severity of anus changes', $('#fp_anus_changes'))
                return
            } else if (fp_blood_in_urine == '' || fp_blood_in_urine == null) {
                error('Provide severity of blood in urine', $('#fp_blood_in_urine'))
                return
            } else if (fp_diff_urinating == '' || fp_diff_urinating == null) {
                error('Provide severity of difficulty in urinating', $('#fp_diff_urinating'))
                return
            } else if (fp_painful_urine == '' || fp_painful_urine == null) {
                error('Provide severity of painful urination', $('#fp_painful_urine'))
                return
            } else if (fp_feel_like_urine == '' || fp_feel_like_urine == null) {
                error('Provide severity of urination frequency', $('#fp_feel_like_urine'))
                return
            } else if (fp_urine_control == '' || fp_urine_control == null) {
                error('Provide severity of urine flow control', $('#fp_urine_control'))
                return
            } else if (fp_urine_rate == '' || fp_urine_rate == null) {
                error('Provide severity of urination rate', $('#fp_urine_rate'))
                return
            } else if (fp_vag_dry == '' || fp_vag_dry == null) {
                error('Provide severity of vaginal dryness', $('#fp_vag_dry'))
                return
            }else if (fp_stool_leak == '' || fp_stool_leak == null) {
                error('Provide severity of stool leakage', $('#fp_stool_leak'))
                return
            }else if (fp_tired_or_weak == '' || fp_tired_or_weak == null) {
                error('Provide severity of tiredness / weakness', $('#fp_tired_or_weak'))
                return
            } else if (fp_on_chemo == '' || fp_on_chemo == null) {
                error('Provide a response for chemotherapy', $('#fp_on_chemo'))
                return
            }
            */

      Swal.fire({
        title: "Updating Side Effects",
        allowOutsideClick: false,
        onBeforeOpen: function () {
          Swal.showLoading();
        },
      });

      $("#addModal,#editModal").modal("hide");

      var formData = [
        fp_loose_stool,
        fp_nausea,
        fp_vomiting,
        fp_skin_color,
        fp_anus_changes,
        fp_blood_in_urine,
        fp_diff_urinating,
        fp_painful_urine,
        fp_feel_like_urine,
        fp_urine_control,
        fp_urine_rate,
        fp_vag_dry,
        fp_stool_leak,
        fp_tired_or_weak,
        fp_weight,
        fp_note,
        fp_on_chemo,
        SELECTED_DATE,
        ACTIVE_SIDE_EFFECT_ID,
        treatment_type,
      ];

      $.ajax({
        async: false,
        url: "./API/api_side_effects_update_female_pelvic.php",
        data: { data: formData },
        type: "POST",
        success: function (data) {
          if (data == "1") {
            log("Updated a Side Effect Log", "Update");
            s("Side Effects Updated");
          } else {
            console.log(data);
            e(data);
          }
        },
        fail: function (data) {
          e(data);
        },
        error: function (data) {
          e(data);
        },
      });
    } else if (CANCER_TYPE == "male_pelvic") {
      var mp_blood_in_urine = $("#mp_blood_in_urine").val(),
        mp_diff_urinating = $("#mp_diff_urinating").val(),
        mp_painful_urine = $("#mp_painful_urine").val(),
        mp_urine_rate = $("#mp_urine_rate").val(),
        mp_feel_like_urine = $("#mp_feel_like_urine").val(),
        mp_urine_control = $("#mp_urine_control").val(),
        mp_nausea =
          $("#mp_nausea").val() == "other"
            ? $("#mp_nausea_other").val()
            : $("#mp_nausea").val(),
        mp_vomiting = $("#mp_vomiting").val(),
        mp_loose_stool = $("#mp_loose_stool").val(),
        mp_anus_changes = $("#mp_anus_changes").val(),
        mp_blood_from_anus = $("#mp_blood_from_anus").val(),
        mp_diff_stooling = $("#mp_diff_stooling").val(),
        mp_belly_tight =
          $("#mp_belly_tight").val() == "other"
            ? $("#mp_belly_tight_other").val()
            : $("#mp_belly_tight").val(),
        mp_stool_leak = $("#mp_stool_leak").val(),
        mp_erection =
          $("#mp_erection").val() == "other"
            ? $("#mp_erection_other").val()
            : $("#mp_erection").val(),
        mp_diff_in_releases =
          $("#mp_diff_in_releases").val() == "other"
            ? $("#mp_diff_in_releases_other").val()
            : $("#mp_diff_in_releases").val(),
        mp_decreased_desire =
          $("#mp_decreased_desire").val() == "other"
            ? $("#mp_decreased_desire_other").val()
            : $("#mp_decreased_desire").val(),
        mp_painful_sex =
          $("#mp_painful_sex").val() == "other"
            ? $("#mp_painful_sex_other").val()
            : $("#mp_painful_sex").val(),
        mp_tired_or_weak = $("#mp_tired_or_weak").val(),
        mp_weight = $("#mp_weight").val(),
        mp_note = $("#mp_note").val(),
        mp_on_chemo = $("#mp_on_chemo").val();

      /*
            if (mp_blood_in_urine == '' || mp_blood_in_urine == null) {
                error('Provide severity of blood in urine', $('#mp_blood_in_urine'))
                return
            } else if (mp_diff_urinating == '' || mp_diff_urinating == null) {
                error('Provide severity of difficulty in urinating', $('#mp_diff_urinating'))
                return
            } else if (mp_painful_urine == '' || mp_painful_urine == null) {
                error('Provide severity of painful urination', $('#mp_painful_urine'))
                return
            } else if (mp_urine_rate == '' || mp_urine_rate == null) {
                error('Provide rate of urination', $('#mp_urine_rate'))
                return
            } else if (mp_feel_like_urine == '' || mp_feel_like_urine == null) {
                error('Provide severity of skin color changes', $('#mp_feel_like_urine'))
                return
            } else if (mp_urine_control == '' || mp_urine_control == null) {
                error('Provide severity of urine control', $('#mp_urine_control'))
                return
            } else if (mp_nausea == '' || mp_nausea == null) {
                error('Provide a severity of nausea', $('#mp_nausea'))
                return
            } else if (mp_vomiting == '' || mp_vomiting == null) {
                error('Provide a severity of vomiting', $('#mp_vomiting'))
                return
            } else if (mp_loose_stool == '' || mp_loose_stool == null) {
                error('Provide a severity of loose stools', $('#mp_loose_stool'))
                return
            } else if (mp_anus_changes == '' || mp_anus_changes == null) {
                error('Provide a severity of anus changes', $('#mp_anus_changes'))
                return
            } else if (mp_blood_from_anus == '' || mp_blood_from_anus == null) {
                error('Provide a severity of blood from anus', $('#mp_blood_from_anus'))
                return
            } else if (mp_diff_stooling == '' || mp_diff_stooling == null) {
                error('Provide a severity of stooling difficulty', $('#mp_diff_stooling'))
                return
            } else if (mp_belly_tight == '' || mp_belly_tight == null) {
                error('Provide a severity of belly tightness', $('#mp_belly_tight'))
                return
            } else if (mp_stool_leak == '' || mp_stool_leak == null) {
                error('Provide a severity of stool leakage', $('#mp_stool_leak'))
                return
            } else if (mp_erection == '' || mp_erection == null) {
                error('Provide a severity of erection maintenance', $('#mp_erection'))
                return
            } else if (mp_diff_in_releases == '' || mp_diff_in_releases == null) {
                error('Provide a severity of difficulty in releasing sperm', $('#mp_diff_in_releases'))
                return
            } else if (mp_decreased_desire == '' || mp_decreased_desire == null) {
                error('Provide a severity of decreased sexual desire', $('#mp_decreased_desire'))
                return
            } else if (mp_painful_sex == '' || mp_painful_sex == null) {
                error('Provide a severity of painful sex', $('#mp_painful_sex'))
                return
            } else if (mp_tired_or_weak == '' || mp_tired_or_weak == null) {
                error('Provide a severity of tiredness', $('#mp_tired_or_weak'))
                return
            } else if (mp_on_chemo == '' || mp_on_chemo == null) {
                error('Provide an option for chemotherapy', $('#mp_on_chemo'))
                return
            }
            */

      Swal.fire({
        title: "Updating Side Effects",
        allowOutsideClick: false,
        onBeforeOpen: function () {
          Swal.showLoading();
        },
      });

      $("#addModal,#editModal").modal("hide");

      var formData = [
        mp_blood_in_urine,
        mp_diff_urinating,
        mp_painful_urine,
        mp_urine_rate,
        mp_feel_like_urine,
        mp_urine_control,
        mp_nausea,
        mp_vomiting,
        mp_loose_stool,
        mp_anus_changes,
        mp_blood_from_anus,
        mp_diff_stooling,
        mp_belly_tight,
        mp_stool_leak,
        mp_erection,
        mp_diff_in_releases,
        mp_decreased_desire,
        mp_painful_sex,
        mp_tired_or_weak,
        mp_weight,
        mp_note,
        mp_on_chemo,
        SELECTED_DATE,
        ACTIVE_SIDE_EFFECT_ID,
        treatment_type,
      ];

      $.ajax({
        async: false,
        url: "./API/api_side_effects_update_male_pelvic.php",
        data: { data: formData },
        type: "POST",
        success: function (data) {
          if (data == "1") {
            log("Updated a Side Effect Log", "Update");
            s("Side Effects Updated");
          } else {
            console.log(data);
            e(data);
          }
        },
        fail: function (data) {
          e(data);
        },
        error: function (data) {
          e(data);
        },
      });
    }
  });

  $("#datepicker").on("click", function () {
    loadData();
  });

  function afterData() {
    $("td")
      .off("click")
      .on("click", function () {
        let target = $(this).find("a"),
          id = target.attr("id");

        SELECTED_DATE =
          target.text() +
          "-" +
          $(this).attr("data-month") +
          "-" +
          $(this).attr("data-year");

        if (target.hasClass("has_side_effect")) {
          getSavedSideEffects(id);
          ACTIVE_SIDE_EFFECT_ID = id;
          $("#add-data").hide();
          $("#update-data").show();
          $(".empty_state").hide();
          $(".side_effect_items").show();
          $(".feelings,.severity_text").addClass("d-none");
        } else {
          $(".empty_state").show();
          $(".side_effect_items").hide();
          $(".es_message").text("No side effects logged on this day.");
          $(".start_log").show();
          ACTIVE_SIDE_EFFECT_ID = "";
          $("a").removeClass("ui-state-active");
          target.addClass("ui-state-active");
          clearForm();
          $("#add-data").show();
          $("#update-data").hide();
        }
      });
  }

  function getSavedSideEffects(id) {
    let URL = "api_side_effects_get_one";

    if (CANCER_TYPE == "breast") {
      URL = "api_side_effects_get_one_breast";
    } else if (CANCER_TYPE == "head_and_neck") {
      URL = "api_side_effects_get_one_head_and_neck";
    } else if (CANCER_TYPE == "female_pelvic") {
      URL = "api_side_effects_get_one_female_pelvic";
    } else if (CANCER_TYPE == "male_pelvic") {
      URL = "api_side_effects_get_one_male_pelvic";
    }

    $.ajax({
      async: false,
      url: "./API/" + URL + ".php?id=" + id,
      type: "POST",
      success: function (data) {
        console.log(data);
        if (data != 0) {
          applyRetrievedData(JSON.parse(data));
        }
      },
      fail: function (data) {
        console.log(data);
        e("Cannot retrieve side effects :/<br><sub>Try again later.</sub>");
      },
      error: function (data) {
        console.log(data);
        e("Cannot retrieve side effects :/<br><sub>Try again later.</sub>");
      },
    });
  }

  function applyRetrievedData(data) {
    // $('.current-state').html('Details of Saved Side Effects')
    // $('.sub-state').html('Saved on <b>' + data[2] + '</b> at <b>' + data[3] + '</b>')
    $(".sub-state").html("Side effects logged on " + data[2]);

    if (CANCER_TYPE == "breast") {
      selectOption("#b_hair_loss", data[4]);
      selectOption("#b_arm_swelling", data[5]);
      selectOption("#b_swallowing_difficulty", data[6]);
      selectOption("#b_chest_pain", data[7]);
      selectOption("#b_breast_swelling", data[8] != "None" ? "other" : "None");
      $("#b_breast_swelling_other")
        .focus()
        .val(data[8] != "None" ? data[8] : "")
        .blur();
      selectOption("#b_breast_pain", data[9]);
      selectOption("#b_sensation_loss", data[10]);
      selectOption("#b_skin_color", data[11]);
      selectOption("#b_tired_or_weak", data[12]);
      $("#b_weight").focus().val(data[13]).blur();
      $("#b_hb").focus().val(data[14]).blur();
      $("#b_pcv").focus().val(data[15]).blur();
      $("#b_anc").focus().val(data[16]).blur();
      $("#b_platelet").focus().val(data[17]).blur();
      $("#b_note").focus().val(data[18]).blur();
      $("#b_wbc").focus().val(data[19]).blur();
      selectOption("#treatment_type", data[20]);
    } else if (CANCER_TYPE == "head_and_neck") {
      selectOption("#hn_mouth_sore", data[4]);
      selectOption("#hn_diff_in_swallowing", data[5]);

      selectOption("#hn_loss_of_smell", data[6] != "None" ? "other" : "None");
      $("#hn_loss_of_smell_other")
        .focus()
        .val(data[6] != "None" ? data[6] : "")
        .blur();

      selectOption("#hn_taste_changes", data[7]);
      selectOption("#hn_dry_mouth", data[8]);

      selectOption("#hn_mouth_cracking", data[9] != "None" ? "other" : "None");
      $("#hn_mouth_cracking_other")
        .focus()
        .val(data[9] != "None" ? data[9] : "")
        .blur();

      selectOption("#hn_voice_change", data[10]);
      selectOption("#hn_appetite_changes", data[11]);

      selectOption("#hn_nausea", data[12] != "None" ? "other" : "None");
      $("#hn_nausea_other")
        .focus()
        .val(data[12] != "None" ? data[12] : "")
        .blur();

      selectOption("#hn_vomiting", data[13]);
      selectOption("#hn_skin_color_changes", data[14]);
      selectOption("#hn_tired_or_weak", data[15]);
      $("#hn_weight").focus().val(data[16]).blur();
      $("#hn_note").focus().val(data[17]).blur();
      selectOption("#hn_on_chemo", data[18]);
      selectOption("#treatment_type", data[19]);
    } else if (CANCER_TYPE == "female_pelvic") {
      selectOption("#fp_loose_stool", data[4]);

      selectOption("#fp_nausea", data[5] != "None" ? "other" : "None");
      $("#fp_nausea_other")
        .focus()
        .val(data[5] != "None" ? data[5] : "")
        .blur();

      selectOption("#fp_vomiting", data[6]);
      selectOption("#fp_skin_color", data[7]);
      selectOption("#fp_anus_changes", data[8]);
      selectOption("#fp_blood_in_urine", data[9]);
      selectOption("#fp_diff_urinating", data[10]);
      selectOption("#fp_painful_urine", data[11]);
      selectOption("#fp_feel_like_urine", data[12]);
      selectOption("#fp_urine_control", data[13]);
      selectOption("#fp_urine_rate", data[14]);
      selectOption("#fp_vag_dry", data[15]);
      selectOption("#fp_stool_leak", data[16]);
      selectOption("#fp_tired_or_weak", data[17]);
      $("#fp_weight").focus().val(data[18]).blur();
      $("#fp_note").focus().val(data[19]).blur();
      selectOption("#fp_on_chemo", data[20]);
      selectOption("#treatment_type", data[21]);
    } else if (CANCER_TYPE == "male_pelvic") {
      selectOption("#mp_blood_in_urine", data[4]);
      selectOption("#mp_diff_urinating", data[5]);
      selectOption("#mp_painful_urine", data[6]);
      selectOption("#mp_urine_rate", data[7]);
      selectOption("#mp_feel_like_urine", data[8]);
      selectOption("#mp_urine_control", data[9]);

      selectOption("#mp_nausea", data[10] != "None" ? "other" : "None");
      $("#mp_nausea_other")
        .focus()
        .val(data[10] != "None" ? data[10] : "")
        .blur();

      selectOption("#mp_vomiting", data[11]);
      selectOption("#mp_loose_stool", data[12]);
      selectOption("#mp_anus_changes", data[13]);

      selectOption(
        "#mp_blood_from_anus",
        data[14] != "None" ? "other" : "None"
      );
      $("#mp_blood_from_anus_other")
        .focus()
        .val(data[14] != "None" ? data[14] : "")
        .blur();

      selectOption("#mp_diff_stooling", data[15]);

      selectOption("#mp_belly_tight", data[16] != "None" ? "other" : "None");
      $("#mp_belly_tight_other")
        .focus()
        .val(data[16] != "None" ? data[16] : "")
        .blur();

      selectOption("#mp_stool_leak", data[17]);

      selectOption("#mp_erection", data[18] != "None" ? "other" : "None");
      $("#mp_erection_other")
        .focus()
        .val(data[18] != "None" ? data[18] : "")
        .blur();

      selectOption(
        "#mp_diff_in_releases",
        data[19] != "None" ? "other" : "None"
      );
      $("#mp_diff_in_releases_other")
        .focus()
        .val(data[19] != "None" ? data[19] : "")
        .blur();

      selectOption(
        "#mp_decreased_desire",
        data[20] != "None" ? "other" : "None"
      );
      $("#mp_decreased_desire_other")
        .focus()
        .val(data[20] != "None" ? data[20] : "")
        .blur();

      selectOption("#mp_painful_sex", data[21] != "None" ? "other" : "None");
      $("#mp_painful_sex_other")
        .focus()
        .val(data[21] != "None" ? data[21] : "")
        .blur();

      selectOption("#mp_tired_or_weak", data[22]);

      $("#mp_weight").focus().val(data[23]).blur();
      $("#mp_note").focus().val(data[24]).blur();

      selectOption("#mp_on_chemo", data[25]);
      selectOption("#treatment_type", data[26]);
    }

    $(".sweetselect.sfx_select").each(function () {
      $(this)
        .siblings(".extender")
        .find("span")
        .html($(this).find("option:selected").text());
    });
  }

  $(".extender").remove();
  $(".sweetselect.sfx_select").each(function () {
    $(this).before(
      '<div class="extender"><span>' +
        $(this).find("option:selected").text() +
        '</span><i class="bx bx-chevron-down"></i></div>'
    );
    $(this).css({ filter: "opacity(0)", position: "absolute", top: `55.5px` });
  });

  $(".sweetselect.sfx_select").on("change", function () {
    $(this)
      .siblings(".extender")
      .find("span")
      .html($(this).find("option:selected").text());
    $(this).css({ filter: "opacity(0)", position: "absolute", top: `55.5px` });
  });

  function selectOption(element, value) {
    $(element).find("option").attr("selected", false);
    $(element)
      .find("option")
      .each(function () {
        if ($(this).attr("value") == value) {
          $(this).attr("selected", true);
        } else {
          $(this).attr("selected", false);
        }
      });
    let context = $(element).html();
    $(element).html(context);
    if (value != "") {
      if (value == "None") {
        changeColor($(element), colors.None);
      } else if (value == "Mild") {
        changeColor($(element), colors.Mild);
      } else if (value == "Moderate") {
        changeColor($(element), colors.Moderate);
      } else if (value == "Severe") {
        changeColor($(element), colors.Severe);
      } else if (value == "other") {
        changeColor($(element), colors.Other);
        $(element).siblings(".simple_flex").show();
      }
    } else {
      changeColor($(element), colors._empty);
    }
  }

  function processData(data) {
    console.log(data);

    data.forEach((item) => {
      let id = item[0],
        arr = item[1].split("-");
      (day = arr[0]),
        (month = arr[1]),
        (year = arr[2]),
        $(".ui-datepicker-calendar a").each(function () {
          let t = $(this),
            p = t.parent(),
            this_day = t.text(),
            this_month = p.attr("data-month"),
            this_year = p.attr("data-year");

          t.removeAttr("href");

          if (this_day === day && this_month === month && this_year === year) {
            t.addClass("ui-state-default ui-state-highlight has_side_effect");
            t.attr("id", id);
          }
        });
    });

    afterData();
  }

  function loadData() {
    $.ajax({
      async: false,
      url: "./API/api_side_effects_read.php",
      type: "POST",
      success: function (data) {
        console.log(data);
        if (data != 0) {
          processData(JSON.parse(data));
          log("Viewed Saved Side Effects", "View");
        }
      },
      fail: function (data) {
        console.log(data);
        e("Cannot retrieve side effects :/<br><sub>Try again later.</sub>");
      },
      error: function (data) {
        console.log(data);
        e("Cannot retrieve side effects :/<br><sub>Try again later.</sub>");
      },
    });
  }

  function clearForm() {
    $(".current-state").html("Log a Side Effect");
    $(".sub-state").html(
      "No side effects have been logged today. Log them below"
    );
    $("input,textarea").val("");
    $(".image_to_upload").remove();
    $(".output_contents").empty();
    $(".input_item").hide();
    // $('.sfx_select').removeAttr('style')
    try {
      $("select.sweetselect").val("").change();
    } catch (e) {}
  }

  function s(s) {
    Swal.fire({
      title: s + " successfully",
      type: "success",
    });
    loadData();
  }

  function e(e) {
    console.log(e);
    Swal.fire({
      title: "Oops",
      html: e,
      type: "error",
    });
  }

  function error(message, element) {
    if (element != "") {
      try {
        $("html, body, .card").animate(
          {
            scrollTop: element.offset().top,
          },
          500
        );
        element.addClass("error");
        setTimeout(() => {
          element.removeClass("error");
        }, 3000);
      } catch (e) {
        console.trace(e);
      }
    }
    Swal.fire({
      title: "Oops!",
      html: message,
      type: "warning",
    });
  }

  // Initially show the Chemotherapy effects div and hide others
  $("#chemotherapy-effects").show();
  $("#radiotherapy-effects, #immunotherapy-effects, #surgery-effects").hide();
  
  // Event listener for dropdown change
  $("#treatment_type").on("change", function () {
    const selectedValue = $(this).val(); // Get the selected value

    // Hide all effect divs
    $(
      "#chemotherapy-effects, #radiotherapy-effects, #immunotherapy-effects, #surgery-effects"
    ).hide();

    // Show the corresponding div based on the selected value

    if (selectedValue === "Chemotherapy") {
      console.log(selectedValue,"selected value")
      $("#chemotherapy-effects").show();
    } else if (selectedValue === "Radiotherapy") {
      console.log(selectedValue,"selected value")
      $("#radiotherapy-effects").show();
    } else if (selectedValue === "Immunotherapy") {
      $("#immunotherapy-effects").show();
    } else if (selectedValue === "Surgery") {
      $("#surgery-effects").show();
    }
  });

    // Handle click on the caret icon to toggle the dropdown
    $('.custom_prose_dropdown').on('click', function(event) {
      event.stopPropagation(); // Prevent the click event from bubbling up
      const dropdown = $(this);
      const dropdownList = dropdown.find('.prose_select_list');

      // Toggle visibility of the dropdown options
      dropdownList.toggle();

      // Toggle the active class on the dropdown (for caret rotation)
      dropdown.toggleClass('active');
  });

  // Handle click on an option to update the selected item
  $('.prose_select_list li').on('click', function() {
      const selectedOption = $(this).text();
      $('.prose_selected').text(selectedOption); // Update the displayed selection
      $('.custom_prose_dropdown').removeClass('active'); // Reset caret rotation
  });

       // Optional: Close dropdown if clicking outside
       $(document).on('click', function() {
        $('.prose_select_list').hide(); // Close dropdown when clicking outside
        $('.custom_prose_dropdown').removeClass('active'); // Reset caret rotation
    });
});
