/**
 * 根据iframe对象获取iframe的window对象
 * @param frame
 * @returns {Boolean}
 */
function GetFrameWindow(frame) {
    return frame && typeof(frame) === 'object' && frame.tagName === 'IFRAME' && frame.contentWindow;
}

function NameSpace(path, cb) {
    var o = {}, d;
    d = path.split(".");
    o = window[d[0]] = window[d[0]] || {};
    for (var k = 0; k < d.slice(1).length; k++) {
        o = o[d[k + 1]] = o[d[k + 1]] || {};
    }

    if (cb) {
        cb.call(o);
        if (o.ready && typeof o.ready === "function") {
            o.ready.call();
        }
    }
}

/**
 * json对象转字符串
 */
if (!JSON) {
    var JSON = {
        stringify: function(o) {
            var r = [];
            if (typeof o === "string")
                return "\"" + o.replace(/([\'\"\\])/g, "\\$1").replace(/(\n)/g, "\\n").replace(/(\r)/g, "\\r").replace(/(\t)/g, "\\t") + "\"";
            if (typeof o === "object") {
                if (!o.sort) {
                    for (var i in o)
                        r.push("\"" + i + "\":" + obj2str(o[i]));
                    if (!!document.all && !/^\n?function\s*toString\(\)\s*\{\n?\s*\[native code\]\n?\s*\}\n?\s*$/.test(o.toString)) {
                        r.push("toString:" + o.toString.toString());
                    }
                    r = "{" + r.join() + "}";
                } else {
                    for (var i = 0; i < o.length; i++)
                        r.push(obj2str(o[i]));
                    r = "[" + r.join() + "]";
                }
                return r;
            }
            return o.toString();
        }
    };
}

/**
 * 去除字符串左右空格
 */
String.prototype.trim = function() {
    return this.replace(/^\s*/, "").replace(/\s*$/, "");
};

/**
 * 获取url的get参数
 * 
 * @param param
 *            要获取的参数名称，如果不传，则返回整个参数对象
 * @returns
 */
String.prototype.URLParams = function(param) {
    var params = {};
    var href = /^http/i.test(this) ? this : window.location.toString();
    var uri = href.split("?");
    if (!uri[1])
        return null;

    uri = uri[1].split("#")[0];

    var paramSet = uri.split("&");
    var temp = [];
    for (index in paramSet) {
        temp = paramSet[index].split("=");
        params[temp[0]] = temp[1];
    }

    if (param) {
        if (params[param])
            return params[param];
        else
            return null;
    } else {
        return params;
    }
};
/**
 * 字符串模版替换
 * 
 * @param this
 *            需要替换的字符串，例如：我是{{key1}}替换的字符串{{key2}}。
 * @param data
 *            替换的数据。json格式的数据或者数组。 eg： str：我是{{key1}}替换的字符串{{key2}}。
 *            data：{key1:"替换",key2:"替换2"}
 * 
 * str：我是{{0}}替换的字符串{{1}}。 data：["替换","替换2"]
 * @returns
 */
String.prototype.template = function(data) {
    var str = this;
    for (var key in data) {
        var value = data[key];
        if (value === null)
            value = "&nbsp;";
        str = str.replace(new RegExp("{{" + key + "}}", "gm"), value);
    }
    return str;
};
/**
 * 字符串替换所有匹配元素
 * 
 * @param old
 *            原元素
 * @param news
 *            替换元素
 * @returns
 */
String.prototype.replaceAll = function(old, news) {
    return this.replace(new RegExp(old, "gm"), news);
};

/**
 * 数组操作函数。去除数组中重复元素
 * 
 * @returns
 */
Array.prototype.unique = function() {
    var i, tmp = {};
    for (i = 0; i < this.length; i++) {
        if (typeof(tmp[this[i]]) === "undefined")
            tmp[this[i]] = 1;
    }
    this.length = 0;
    for (i in tmp)
        this[this.length] = i;
    return this;
};
/**
 * 数组操作函数。判断元素是否存在于数组中
 * 
 * @param value
 *            判断值
 * @returns {Number} 如果存在返回元素下标，不存在返回-1
 */
Array.prototype.contains = function(value) {
    for (var i = 0; i < this.length; i++) {
        if (this[i] === value) {
            return i;
        }
    }
    return -1;
};
/**
 * 格式化时间
 * 
 * @param format
 * @returns
 */
Date.prototype.format = function(format) {
    if (!format) {
        format = "yyyy-MM-dd hh:mm:ss";
    }
    var o = {
        "M+": this.getMonth() + 1,
        // month
        "d+": this.getDate(),
        // day
        "h+": this.getHours(),
        // hour
        "m+": this.getMinutes(),
        // minute
        "s+": this.getSeconds(),
        // second
        "q+": Math.floor((this.getMonth() + 3) / 3),
        // quarter
        "S": this.getMilliseconds()
                // millisecond
    };

    if (/(y+)/.test(format)) {
        format = format.replace(RegExp.$1, (this.getFullYear() + "").substr(4 - RegExp.$1.length));
    }

    for (var k in o) {
        if (new RegExp("(" + k + ")").test(format)) {
            format = format.replace(RegExp.$1, RegExp.$1.length === 1 ? o[k] : ("00" + o[k]).substr(("" + o[k]).length));
        }
    }
    return format;
};

jQuery.ajaxSetup({
    error: function(rsp) {
        if (rsp.status != 901 && rsp.status != 902) {
            if (rsp.statusText === "timeout") {
                jQuery.alert("响应超时！(" + this.url.split("?")[0] + ")");
            } else {
                jQuery.alert(rsp.statusText + ':' + rsp.responseText);
            }
        }
    },
    statusCode: {
        901: function() {
            jQuery.alert("未登录！");
        },
        902: function(rsp) {
            jQuery.alert("资源【" + rsp.responseText.toLowerCase() + "】未授权！");
        }
    },
    timeout: 30 * 1000
});

/**
 * dialog的封装操作
 */
(function($) {
    $.dialog = function(options) {
        var _default = {
            minimizable: false,
            modal: true,
            collapsible: false,
            maximizable: false,
            onClose: function() {
                $(this).dialog('destroy');
            }
        };

        options = $.extend(_default, options);

        var dialog = $(options.el || "<div/>");
        if (options.bodyStyle) {
            dialog.css(options.bodyStyle);
        }

        $.get(options.href, function(rsp) {
            options.href = null;
            dialog.dialog(options);
            var content = dialog.find('div.dialog-content');
            content.html($.fn.panel.defaults.extractor(rsp));
            if ($.parser) {
                $.parser.parse(content);
            }
            if (options.onLoad) {
                options.onLoad.call(dialog);
            }
        }, "html");

        dialog.close = function() {
            dialog.dialog('destroy');
        };
        return dialog;
    };

    $.fn.toJson = function() {
        var arrayValue = $(this).serializeArray();
        var json = {};
        $.each(arrayValue, function() {
            var item = this;
            if (json[item["name"]]) {
                json[item["name"]] += "," + item["value"];
            } else {
                json[item["name"]] = item["value"];
            }
        });
        return json;
    };

    $.alert = function() {
        if (arguments.length === 1) {
            $.messager.alert("提示", arguments[0]);
        } else if (arguments.length === 2 && typeof arguments[1] === "string") {
            $.messager.alert("提示", arguments[0], arguments[1]);
        } else if (arguments.length === 2 && typeof arguments[1] === "function") {
            $.messager.alert("提示", arguments[0], "", arguments[1]);
        } else if (arguments.length === 3) {
            $.messager.alert("提示", arguments[0], arguments[1], arguments[2]);
        }
    };
    $.confirm = function(msg, callback) {
        $.messager.confirm("确认", msg, callback);
    };

    $.extend($.fn.tree.methods, {
        unSelect: function(jq, target) {
            return jq.each(function() {
                $(target).removeClass("tree-node-selected");
            });
        }
    });

    $.fn.my97 = function(options, params) {
        if (typeof options == "string") {
            return $.fn.my97.methods[options](this, params);
        }
        options = options || {};
        if (!WdatePicker) {
            alert("未引入My97js包！");
            return;
        }
        return this.each(function() {
            var data = $.data(this, "my97");
            var newOptions;
            if (data) {
                newOptions = $.extend(data.options, options);
                data.opts = newOptions;
            } else {
                newOptions = $.extend({}, $.fn.my97.defaults, $.fn.my97.parseOptions(this), options);
                $.data(this, "my97", {
                    options: newOptions
                });
            }
            $(this).addClass('Wdate').click(function() {
                WdatePicker(newOptions);
            });
        });
    };
    $.fn.my97.methods = {
        setValue: function(target, params) {
            target.val(params);
        },
        getValue: function(target) {
            return target.val();
        },
        clearValue: function(target) {
            target.val('');
        }
    };
    $.fn.my97.parseOptions = function(target) {
        return $.extend({}, $.parser.parseOptions(target, ["el", "vel", "weekMethod", "lang", "skin", "dateFmt", "realDateFmt", "realTimeFmt", "realFullFmt", "minDate", "maxDate", "startDate", {
                doubleCalendar: "boolean",
                enableKeyboard: "boolean",
                enableInputMask: "boolean",
                autoUpdateOnChanged: "boolean",
                firstDayOfWeek: "number",
                isShowWeek: "boolean",
                highLineWeekDay: "boolean",
                isShowClear: "boolean",
                isShowToday: "boolean",
                isShowOthers: "boolean",
                readOnly: "boolean",
                errDealMode: "boolean",
                autoPickDate: "boolean",
                qsEnabled: "boolean",
                autoShowQS: "boolean",
                opposite: "boolean"
            }
        ]));
    };
    $.fn.my97.defaults = {
        dateFmt: 'yyyy-MM-dd HH:mm:ss'
    };

    $.parser.plugins.push('my97');
})(jQuery);


jQuery(function() {
    $("#bt_loading").ajaxStart(function() {
        $(this).height($(document).height()).width($(document).width()).show();
        $("#bt_loading_progress").show();
    });

    $("#bt_loading").ajaxStop(function() {
        $(this).hide();
        $("#bt_loading_progress").hide();
    });
    $.extend($.fn.datagrid.defaults, {
        loadMsg: null,
        onLoadSuccess: function(data) {
            if ((typeof data === 'object' && data.total == 0) || (typeof data === 'object' && data.sort && data.length == 0)) {
                var body = $(this).data().datagrid.dc.body2;
                body.find('table tbody').append('<tr><td width="' + body.width() + '" style="height: 25px; text-align: center;">没有数据</td></tr>');
            }
        },
        pageList: [20, 30, 40, 50],
        pageSize: 20
    });
    
    $.extend($.fn.datagrid.methods, {
        getEditing: function(jq) {
            var idxs = [];
            jq.prev("div.datagrid-view2").find('tr.datagrid-row-editing').each(function(){
                idxs.push($(this).attr('datagrid-row-index'));
            });
            return idxs;
        }
    });

    window.onerror = function(msg, url, line) {
        $("#bt_loading").hide();
        $("#bt_loading_progress").hide();
        $.alert("<div style='word-wrap: break-word;width: 220px;float: right;'>地址：" + url + "<br/>行：" + line + "<br/>错误：" + msg + "</div>", "error");
    };
});