!(function (e, t) {
    "use strict";
    "object" == typeof module && "object" == typeof module.exports
        ? (module.exports = e.document
              ? t(e, !0)
              : function (e) {
                    if (!e.document)
                        throw new Error(
                            "jQuery requires a window with a document"
                        );
                    return t(e);
                })
        : t(e);
})("undefined" != typeof window ? window : this, function (w, t) {
    "use strict";
    function y(e) {
        return (
            "function" == typeof e &&
            "number" != typeof e.nodeType &&
            "function" != typeof e.item
        );
    }
    function b(e) {
        return null != e && e === e.window;
    }
    var n = [],
        i = Object.getPrototypeOf,
        c = n.slice,
        _ = n.flat
            ? function (e) {
                  return n.flat.call(e);
              }
            : function (e) {
                  return n.concat.apply([], e);
              },
        u = n.push,
        o = n.indexOf,
        r = {},
        s = r.toString,
        T = r.hasOwnProperty,
        h = T.toString,
        d = h.call(Object),
        g = {},
        x = w.document,
        f = { type: !0, src: !0, nonce: !0, noModule: !0 };
    function k(e, t, n) {
        var i,
            o,
            r = (n = n || x).createElement("script");
        if (((r.text = e), t))
            for (i in f)
                (o = t[i] || (t.getAttribute && t.getAttribute(i))) &&
                    r.setAttribute(i, o);
        n.head.appendChild(r).parentNode.removeChild(r);
    }
    function p(e) {
        return null == e
            ? e + ""
            : "object" == typeof e || "function" == typeof e
            ? r[s.call(e)] || "object"
            : typeof e;
    }
    var e = "3.6.0",
        E = function (e, t) {
            return new E.fn.init(e, t);
        };
    function C(e) {
        var t = !!e && "length" in e && e.length,
            n = p(e);
        return (
            !y(e) &&
            !b(e) &&
            ("array" === n ||
                0 === t ||
                ("number" == typeof t && 0 < t && t - 1 in e))
        );
    }
    (E.fn = E.prototype =
        {
            jquery: e,
            constructor: E,
            length: 0,
            toArray: function () {
                return c.call(this);
            },
            get: function (e) {
                return null == e
                    ? c.call(this)
                    : e < 0
                    ? this[e + this.length]
                    : this[e];
            },
            pushStack: function (e) {
                e = E.merge(this.constructor(), e);
                return (e.prevObject = this), e;
            },
            each: function (e) {
                return E.each(this, e);
            },
            map: function (n) {
                return this.pushStack(
                    E.map(this, function (e, t) {
                        return n.call(e, t, e);
                    })
                );
            },
            slice: function () {
                return this.pushStack(c.apply(this, arguments));
            },
            first: function () {
                return this.eq(0);
            },
            last: function () {
                return this.eq(-1);
            },
            even: function () {
                return this.pushStack(
                    E.grep(this, function (e, t) {
                        return (t + 1) % 2;
                    })
                );
            },
            odd: function () {
                return this.pushStack(
                    E.grep(this, function (e, t) {
                        return t % 2;
                    })
                );
            },
            eq: function (e) {
                var t = this.length,
                    e = +e + (e < 0 ? t : 0);
                return this.pushStack(0 <= e && e < t ? [this[e]] : []);
            },
            end: function () {
                return this.prevObject || this.constructor();
            },
            push: u,
            sort: n.sort,
            splice: n.splice,
        }),
        (E.extend = E.fn.extend =
            function () {
                var e,
                    t,
                    n,
                    i,
                    o,
                    r = arguments[0] || {},
                    s = 1,
                    a = arguments.length,
                    l = !1;
                for (
                    "boolean" == typeof r &&
                        ((l = r), (r = arguments[s] || {}), s++),
                        "object" == typeof r || y(r) || (r = {}),
                        s === a && ((r = this), s--);
                    s < a;
                    s++
                )
                    if (null != (e = arguments[s]))
                        for (t in e)
                            (n = e[t]),
                                "__proto__" !== t &&
                                    r !== n &&
                                    (l &&
                                    n &&
                                    (E.isPlainObject(n) ||
                                        (i = Array.isArray(n)))
                                        ? ((o = r[t]),
                                          (o =
                                              i && !Array.isArray(o)
                                                  ? []
                                                  : i || E.isPlainObject(o)
                                                  ? o
                                                  : {}),
                                          (i = !1),
                                          (r[t] = E.extend(l, o, n)))
                                        : void 0 !== n && (r[t] = n));
                return r;
            }),
        E.extend({
            expando: "jQuery" + (e + Math.random()).replace(/\D/g, ""),
            isReady: !0,
            error: function (e) {
                throw new Error(e);
            },
            noop: function () {},
            isPlainObject: function (e) {
                return (
                    !(!e || "[object Object]" !== s.call(e)) &&
                    (!(e = i(e)) ||
                        ("function" ==
                            typeof (e =
                                T.call(e, "constructor") && e.constructor) &&
                            h.call(e) === d))
                );
            },
            isEmptyObject: function (e) {
                for (var t in e) return !1;
                return !0;
            },
            globalEval: function (e, t, n) {
                k(e, { nonce: t && t.nonce }, n);
            },
            each: function (e, t) {
                var n,
                    i = 0;
                if (C(e))
                    for (
                        n = e.length;
                        i < n && !1 !== t.call(e[i], i, e[i]);
                        i++
                    );
                else for (i in e) if (!1 === t.call(e[i], i, e[i])) break;
                return e;
            },
            makeArray: function (e, t) {
                t = t || [];
                return (
                    null != e &&
                        (C(Object(e))
                            ? E.merge(t, "string" == typeof e ? [e] : e)
                            : u.call(t, e)),
                    t
                );
            },
            inArray: function (e, t, n) {
                return null == t ? -1 : o.call(t, e, n);
            },
            merge: function (e, t) {
                for (var n = +t.length, i = 0, o = e.length; i < n; i++)
                    e[o++] = t[i];
                return (e.length = o), e;
            },
            grep: function (e, t, n) {
                for (var i = [], o = 0, r = e.length, s = !n; o < r; o++)
                    !t(e[o], o) != s && i.push(e[o]);
                return i;
            },
            map: function (e, t, n) {
                var i,
                    o,
                    r = 0,
                    s = [];
                if (C(e))
                    for (i = e.length; r < i; r++)
                        null != (o = t(e[r], r, n)) && s.push(o);
                else for (r in e) null != (o = t(e[r], r, n)) && s.push(o);
                return _(s);
            },
            guid: 1,
            support: g,
        }),
        "function" == typeof Symbol &&
            (E.fn[Symbol.iterator] = n[Symbol.iterator]),
        E.each(
            "Boolean Number String Function Array Date RegExp Object Error Symbol".split(
                " "
            ),
            function (e, t) {
                r["[object " + t + "]"] = t.toLowerCase();
            }
        );
    function A(e, t, n) {
        for (var i = [], o = void 0 !== n; (e = e[t]) && 9 !== e.nodeType; )
            if (1 === e.nodeType) {
                if (o && E(e).is(n)) break;
                i.push(e);
            }
        return i;
    }
    function S(e, t) {
        for (var n = []; e; e = e.nextSibling)
            1 === e.nodeType && e !== t && n.push(e);
        return n;
    }
    var e = (function (o) {
            function h(e, t) {
                return (
                    (e = "0x" + e.slice(1) - 65536),
                    t ||
                        (e < 0
                            ? String.fromCharCode(65536 + e)
                            : String.fromCharCode(
                                  (e >> 10) | 55296,
                                  (1023 & e) | 56320
                              ))
                );
            }
            function p(e, t) {
                return t
                    ? "\0" === e
                        ? "�"
                        : e.slice(0, -1) +
                          "\\" +
                          e.charCodeAt(e.length - 1).toString(16) +
                          " "
                    : "\\" + e;
            }
            function r() {
                C();
            }
            var e,
                d,
                _,
                s,
                a,
                g,
                m,
                v,
                k,
                c,
                u,
                C,
                w,
                n,
                x,
                f,
                y,
                b,
                A,
                E = "sizzle" + +new Date(),
                l = o.document,
                S = 0,
                L = 0,
                D = le(),
                N = le(),
                O = le(),
                j = le(),
                I = function (e, t) {
                    return e === t && (u = !0), 0;
                },
                P = {}.hasOwnProperty,
                t = [],
                H = t.pop,
                M = t.push,
                q = t.push,
                R = t.slice,
                B = function (e, t) {
                    for (var n = 0, i = e.length; n < i; n++)
                        if (e[n] === t) return n;
                    return -1;
                },
                W =
                    "checked|selected|async|autofocus|autoplay|controls|defer|disabled|hidden|ismap|loop|multiple|open|readonly|required|scoped",
                i = "[\\x20\\t\\r\\n\\f]",
                F =
                    "(?:\\\\[\\da-fA-F]{1,6}" +
                    i +
                    "?|\\\\[^\\r\\n\\f]|[\\w-]|[^\0-\\x7f])+",
                z =
                    "\\[" +
                    i +
                    "*(" +
                    F +
                    ")(?:" +
                    i +
                    "*([*^$|!~]?=)" +
                    i +
                    "*(?:'((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\"|(" +
                    F +
                    "))|)" +
                    i +
                    "*\\]",
                $ =
                    ":(" +
                    F +
                    ")(?:\\((('((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\")|((?:\\\\.|[^\\\\()[\\]]|" +
                    z +
                    ")*)|.*)\\)|)",
                U = new RegExp(i + "+", "g"),
                X = new RegExp(
                    "^" + i + "+|((?:^|[^\\\\])(?:\\\\.)*)" + i + "+$",
                    "g"
                ),
                V = new RegExp("^" + i + "*," + i + "*"),
                Y = new RegExp("^" + i + "*([>+~]|" + i + ")" + i + "*"),
                Q = new RegExp(i + "|>"),
                G = new RegExp($),
                K = new RegExp("^" + F + "$"),
                J = {
                    ID: new RegExp("^#(" + F + ")"),
                    CLASS: new RegExp("^\\.(" + F + ")"),
                    TAG: new RegExp("^(" + F + "|[*])"),
                    ATTR: new RegExp("^" + z),
                    PSEUDO: new RegExp("^" + $),
                    CHILD: new RegExp(
                        "^:(only|first|last|nth|nth-last)-(child|of-type)(?:\\(" +
                            i +
                            "*(even|odd|(([+-]|)(\\d*)n|)" +
                            i +
                            "*(?:([+-]|)" +
                            i +
                            "*(\\d+)|))" +
                            i +
                            "*\\)|)",
                        "i"
                    ),
                    bool: new RegExp("^(?:" + W + ")$", "i"),
                    needsContext: new RegExp(
                        "^" +
                            i +
                            "*[>+~]|:(even|odd|eq|gt|lt|nth|first|last)(?:\\(" +
                            i +
                            "*((?:-\\d)?\\d*)" +
                            i +
                            "*\\)|)(?=[^-]|$)",
                        "i"
                    ),
                },
                Z = /HTML$/i,
                ee = /^(?:input|select|textarea|button)$/i,
                te = /^h\d$/i,
                ne = /^[^{]+\{\s*\[native \w/,
                ie = /^(?:#([\w-]+)|(\w+)|\.([\w-]+))$/,
                oe = /[+~]/,
                re = new RegExp(
                    "\\\\[\\da-fA-F]{1,6}" + i + "?|\\\\([^\\r\\n\\f])",
                    "g"
                ),
                se = /([\0-\x1f\x7f]|^-?\d)|^-$|[^\0-\x1f\x7f-\uFFFF\w-]/g,
                ae = ye(
                    function (e) {
                        return (
                            !0 === e.disabled &&
                            "fieldset" === e.nodeName.toLowerCase()
                        );
                    },
                    { dir: "parentNode", next: "legend" }
                );
            try {
                q.apply((t = R.call(l.childNodes)), l.childNodes),
                    t[l.childNodes.length].nodeType;
            } catch (e) {
                q = {
                    apply: t.length
                        ? function (e, t) {
                              M.apply(e, R.call(t));
                          }
                        : function (e, t) {
                              for (
                                  var n = e.length, i = 0;
                                  (e[n++] = t[i++]);

                              );
                              e.length = n - 1;
                          },
                };
            }
            function T(t, e, n, u) {
                var i,
                    o,
                    r,
                    s,
                    h,
                    a,
                    l = e && e.ownerDocument,
                    c = e ? e.nodeType : 9;
                if (
                    ((n = n || []),
                    "string" != typeof t ||
                        !t ||
                        (1 !== c && 9 !== c && 11 !== c))
                )
                    return n;
                if (!u && (C(e), (e = e || w), x)) {
                    if (11 !== c && (s = ie.exec(t)))
                        if ((i = s[1])) {
                            if (9 === c) {
                                if (!(a = e.getElementById(i))) return n;
                                if (a.id === i) return n.push(a), n;
                            } else if (
                                l &&
                                (a = l.getElementById(i)) &&
                                A(e, a) &&
                                a.id === i
                            )
                                return n.push(a), n;
                        } else {
                            if (s[2])
                                return q.apply(n, e.getElementsByTagName(t)), n;
                            if (
                                (i = s[3]) &&
                                d.getElementsByClassName &&
                                e.getElementsByClassName
                            )
                                return (
                                    q.apply(n, e.getElementsByClassName(i)), n
                                );
                        }
                    if (
                        d.qsa &&
                        !j[t + " "] &&
                        (!f || !f.test(t)) &&
                        (1 !== c || "object" !== e.nodeName.toLowerCase())
                    ) {
                        if (
                            ((a = t),
                            (l = e),
                            1 === c && (Q.test(t) || Y.test(t)))
                        ) {
                            for (
                                ((l = (oe.test(t) && ge(e.parentNode)) || e) ===
                                    e &&
                                    d.scope) ||
                                    ((r = e.getAttribute("id"))
                                        ? (r = r.replace(se, p))
                                        : e.setAttribute("id", (r = E))),
                                    o = (h = g(t)).length;
                                o--;

                            )
                                h[o] =
                                    (r ? "#" + r : ":scope") + " " + ve(h[o]);
                            a = h.join(",");
                        }
                        try {
                            return q.apply(n, l.querySelectorAll(a)), n;
                        } catch (e) {
                            j(t, !0);
                        } finally {
                            r === E && e.removeAttribute("id");
                        }
                    }
                }
                return v(t.replace(X, "$1"), e, n, u);
            }
            function le() {
                var n = [];
                function i(e, t) {
                    return (
                        n.push(e + " ") > _.cacheLength && delete i[n.shift()],
                        (i[e + " "] = t)
                    );
                }
                return i;
            }
            function ce(e) {
                return (e[E] = !0), e;
            }
            function ue(e) {
                var t = w.createElement("fieldset");
                try {
                    return !!e(t);
                } catch (e) {
                    return !1;
                } finally {
                    t.parentNode && t.parentNode.removeChild(t);
                }
            }
            function he(e, t) {
                for (var n = e.split("|"), i = n.length; i--; )
                    _.attrHandle[n[i]] = t;
            }
            function de(e, t) {
                var n = t && e,
                    i =
                        n &&
                        1 === e.nodeType &&
                        1 === t.nodeType &&
                        e.sourceIndex - t.sourceIndex;
                if (i) return i;
                if (n) for (; (n = n.nextSibling); ) if (n === t) return -1;
                return e ? 1 : -1;
            }
            function fe(t) {
                return function (e) {
                    return "form" in e
                        ? e.parentNode && !1 === e.disabled
                            ? "label" in e
                                ? "label" in e.parentNode
                                    ? e.parentNode.disabled === t
                                    : e.disabled === t
                                : e.isDisabled === t ||
                                  (e.isDisabled !== !t && ae(e) === t)
                            : e.disabled === t
                        : "label" in e && e.disabled === t;
                };
            }
            function pe(s) {
                return ce(function (r) {
                    return (
                        (r = +r),
                        ce(function (e, t) {
                            for (
                                var n, i = s([], e.length, r), o = i.length;
                                o--;

                            )
                                e[(n = i[o])] && (e[n] = !(t[n] = e[n]));
                        })
                    );
                });
            }
            function ge(e) {
                return e && void 0 !== e.getElementsByTagName && e;
            }
            for (e in ((d = T.support = {}),
            (a = T.isXML =
                function (e) {
                    var t = e && e.namespaceURI,
                        e = e && (e.ownerDocument || e).documentElement;
                    return !Z.test(t || (e && e.nodeName) || "HTML");
                }),
            (C = T.setDocument =
                function (e) {
                    var t,
                        e = e ? e.ownerDocument || e : l;
                    return (
                        e != w &&
                            9 === e.nodeType &&
                            e.documentElement &&
                            ((n = (w = e).documentElement),
                            (x = !a(w)),
                            l != w &&
                                (t = w.defaultView) &&
                                t.top !== t &&
                                (t.addEventListener
                                    ? t.addEventListener("unload", r, !1)
                                    : t.attachEvent &&
                                      t.attachEvent("onunload", r)),
                            (d.scope = ue(function (e) {
                                return (
                                    n
                                        .appendChild(e)
                                        .appendChild(w.createElement("div")),
                                    void 0 !== e.querySelectorAll &&
                                        !e.querySelectorAll(
                                            ":scope fieldset div"
                                        ).length
                                );
                            })),
                            (d.attributes = ue(function (e) {
                                return (
                                    (e.className = "i"),
                                    !e.getAttribute("className")
                                );
                            })),
                            (d.getElementsByTagName = ue(function (e) {
                                return (
                                    e.appendChild(w.createComment("")),
                                    !e.getElementsByTagName("*").length
                                );
                            })),
                            (d.getElementsByClassName = ne.test(
                                w.getElementsByClassName
                            )),
                            (d.getById = ue(function (e) {
                                return (
                                    (n.appendChild(e).id = E),
                                    !w.getElementsByName ||
                                        !w.getElementsByName(E).length
                                );
                            })),
                            d.getById
                                ? ((_.filter.ID = function (e) {
                                      var t = e.replace(re, h);
                                      return function (e) {
                                          return e.getAttribute("id") === t;
                                      };
                                  }),
                                  (_.find.ID = function (e, t) {
                                      if (void 0 !== t.getElementById && x)
                                          return (t = t.getElementById(e))
                                              ? [t]
                                              : [];
                                  }))
                                : ((_.filter.ID = function (e) {
                                      var t = e.replace(re, h);
                                      return function (e) {
                                          e =
                                              void 0 !== e.getAttributeNode &&
                                              e.getAttributeNode("id");
                                          return e && e.value === t;
                                      };
                                  }),
                                  (_.find.ID = function (e, t) {
                                      if (void 0 !== t.getElementById && x) {
                                          var n,
                                              i,
                                              o,
                                              r = t.getElementById(e);
                                          if (r) {
                                              if (
                                                  (n =
                                                      r.getAttributeNode(
                                                          "id"
                                                      )) &&
                                                  n.value === e
                                              )
                                                  return [r];
                                              for (
                                                  o = t.getElementsByName(e),
                                                      i = 0;
                                                  (r = o[i++]);

                                              )
                                                  if (
                                                      (n =
                                                          r.getAttributeNode(
                                                              "id"
                                                          )) &&
                                                      n.value === e
                                                  )
                                                      return [r];
                                          }
                                          return [];
                                      }
                                  })),
                            (_.find.TAG = d.getElementsByTagName
                                ? function (e, t) {
                                      return void 0 !== t.getElementsByTagName
                                          ? t.getElementsByTagName(e)
                                          : d.qsa
                                          ? t.querySelectorAll(e)
                                          : void 0;
                                  }
                                : function (e, t) {
                                      var n,
                                          i = [],
                                          o = 0,
                                          r = t.getElementsByTagName(e);
                                      if ("*" !== e) return r;
                                      for (; (n = r[o++]); )
                                          1 === n.nodeType && i.push(n);
                                      return i;
                                  }),
                            (_.find.CLASS =
                                d.getElementsByClassName &&
                                function (e, t) {
                                    if (
                                        void 0 !== t.getElementsByClassName &&
                                        x
                                    )
                                        return t.getElementsByClassName(e);
                                }),
                            (y = []),
                            (f = []),
                            (d.qsa = ne.test(w.querySelectorAll)) &&
                                (ue(function (e) {
                                    var t;
                                    (n.appendChild(e).innerHTML =
                                        "<a id='" +
                                        E +
                                        "'></a><select id='" +
                                        E +
                                        "-\r\\' msallowcapture=''><option selected=''></option></select>"),
                                        e.querySelectorAll(
                                            "[msallowcapture^='']"
                                        ).length &&
                                            f.push(
                                                "[*^$]=" + i + "*(?:''|\"\")"
                                            ),
                                        e.querySelectorAll("[selected]")
                                            .length ||
                                            f.push(
                                                "\\[" +
                                                    i +
                                                    "*(?:value|" +
                                                    W +
                                                    ")"
                                            ),
                                        e.querySelectorAll("[id~=" + E + "-]")
                                            .length || f.push("~="),
                                        (t =
                                            w.createElement(
                                                "input"
                                            )).setAttribute("name", ""),
                                        e.appendChild(t),
                                        e.querySelectorAll("[name='']")
                                            .length ||
                                            f.push(
                                                "\\[" +
                                                    i +
                                                    "*name" +
                                                    i +
                                                    "*=" +
                                                    i +
                                                    "*(?:''|\"\")"
                                            ),
                                        e.querySelectorAll(":checked").length ||
                                            f.push(":checked"),
                                        e.querySelectorAll("a#" + E + "+*")
                                            .length || f.push(".#.+[+~]"),
                                        e.querySelectorAll("\\\f"),
                                        f.push("[\\r\\n\\f]");
                                }),
                                ue(function (e) {
                                    e.innerHTML =
                                        "<a href='' disabled='disabled'></a><select disabled='disabled'><option/></select>";
                                    var t = w.createElement("input");
                                    t.setAttribute("type", "hidden"),
                                        e
                                            .appendChild(t)
                                            .setAttribute("name", "D"),
                                        e.querySelectorAll("[name=d]").length &&
                                            f.push("name" + i + "*[*^$|!~]?="),
                                        2 !==
                                            e.querySelectorAll(":enabled")
                                                .length &&
                                            f.push(":enabled", ":disabled"),
                                        (n.appendChild(e).disabled = !0),
                                        2 !==
                                            e.querySelectorAll(":disabled")
                                                .length &&
                                            f.push(":enabled", ":disabled"),
                                        e.querySelectorAll("*,:x"),
                                        f.push(",.*:");
                                })),
                            (d.matchesSelector = ne.test(
                                (b =
                                    n.matches ||
                                    n.webkitMatchesSelector ||
                                    n.mozMatchesSelector ||
                                    n.oMatchesSelector ||
                                    n.msMatchesSelector)
                            )) &&
                                ue(function (e) {
                                    (d.disconnectedMatch = b.call(e, "*")),
                                        b.call(e, "[s!='']:x"),
                                        y.push("!=", $);
                                }),
                            (f = f.length && new RegExp(f.join("|"))),
                            (y = y.length && new RegExp(y.join("|"))),
                            (e = ne.test(n.compareDocumentPosition)),
                            (A =
                                e || ne.test(n.contains)
                                    ? function (e, t) {
                                          var n =
                                                  9 === e.nodeType
                                                      ? e.documentElement
                                                      : e,
                                              t = t && t.parentNode;
                                          return (
                                              e === t ||
                                              !(
                                                  !t ||
                                                  1 !== t.nodeType ||
                                                  !(n.contains
                                                      ? n.contains(t)
                                                      : e.compareDocumentPosition &&
                                                        16 &
                                                            e.compareDocumentPosition(
                                                                t
                                                            ))
                                              )
                                          );
                                      }
                                    : function (e, t) {
                                          if (t)
                                              for (; (t = t.parentNode); )
                                                  if (t === e) return !0;
                                          return !1;
                                      }),
                            (I = e
                                ? function (e, t) {
                                      if (e === t) return (u = !0), 0;
                                      var n =
                                          !e.compareDocumentPosition -
                                          !t.compareDocumentPosition;
                                      return (
                                          n ||
                                          (1 &
                                              (n =
                                                  (e.ownerDocument || e) ==
                                                  (t.ownerDocument || t)
                                                      ? e.compareDocumentPosition(
                                                            t
                                                        )
                                                      : 1) ||
                                          (!d.sortDetached &&
                                              t.compareDocumentPosition(e) ===
                                                  n)
                                              ? e == w ||
                                                (e.ownerDocument == l &&
                                                    A(l, e))
                                                  ? -1
                                                  : t == w ||
                                                    (t.ownerDocument == l &&
                                                        A(l, t))
                                                  ? 1
                                                  : c
                                                  ? B(c, e) - B(c, t)
                                                  : 0
                                              : 4 & n
                                              ? -1
                                              : 1)
                                      );
                                  }
                                : function (e, t) {
                                      if (e === t) return (u = !0), 0;
                                      var n,
                                          i = 0,
                                          o = e.parentNode,
                                          r = t.parentNode,
                                          s = [e],
                                          a = [t];
                                      if (!o || !r)
                                          return e == w
                                              ? -1
                                              : t == w
                                              ? 1
                                              : o
                                              ? -1
                                              : r
                                              ? 1
                                              : c
                                              ? B(c, e) - B(c, t)
                                              : 0;
                                      if (o === r) return de(e, t);
                                      for (n = e; (n = n.parentNode); )
                                          s.unshift(n);
                                      for (n = t; (n = n.parentNode); )
                                          a.unshift(n);
                                      for (; s[i] === a[i]; ) i++;
                                      return i
                                          ? de(s[i], a[i])
                                          : s[i] == l
                                          ? -1
                                          : a[i] == l
                                          ? 1
                                          : 0;
                                  })),
                        w
                    );
                }),
            (T.matches = function (e, t) {
                return T(e, null, null, t);
            }),
            (T.matchesSelector = function (e, t) {
                if (
                    (C(e),
                    d.matchesSelector &&
                        x &&
                        !j[t + " "] &&
                        (!y || !y.test(t)) &&
                        (!f || !f.test(t)))
                )
                    try {
                        var n = b.call(e, t);
                        if (
                            n ||
                            d.disconnectedMatch ||
                            (e.document && 11 !== e.document.nodeType)
                        )
                            return n;
                    } catch (e) {
                        j(t, !0);
                    }
                return 0 < T(t, w, null, [e]).length;
            }),
            (T.contains = function (e, t) {
                return (e.ownerDocument || e) != w && C(e), A(e, t);
            }),
            (T.attr = function (e, t) {
                (e.ownerDocument || e) != w && C(e);
                var n = _.attrHandle[t.toLowerCase()],
                    n =
                        n && P.call(_.attrHandle, t.toLowerCase())
                            ? n(e, t, !x)
                            : void 0;
                return void 0 !== n
                    ? n
                    : d.attributes || !x
                    ? e.getAttribute(t)
                    : (n = e.getAttributeNode(t)) && n.specified
                    ? n.value
                    : null;
            }),
            (T.escape = function (e) {
                return (e + "").replace(se, p);
            }),
            (T.error = function (e) {
                throw new Error("Syntax error, unrecognized expression: " + e);
            }),
            (T.uniqueSort = function (e) {
                var t,
                    n = [],
                    i = 0,
                    o = 0;
                if (
                    ((u = !d.detectDuplicates),
                    (c = !d.sortStable && e.slice(0)),
                    e.sort(I),
                    u)
                ) {
                    for (; (t = e[o++]); ) t === e[o] && (i = n.push(o));
                    for (; i--; ) e.splice(n[i], 1);
                }
                return (c = null), e;
            }),
            (s = T.getText =
                function (e) {
                    var t,
                        n = "",
                        i = 0,
                        o = e.nodeType;
                    if (o) {
                        if (1 === o || 9 === o || 11 === o) {
                            if ("string" == typeof e.textContent)
                                return e.textContent;
                            for (e = e.firstChild; e; e = e.nextSibling)
                                n += s(e);
                        } else if (3 === o || 4 === o) return e.nodeValue;
                    } else for (; (t = e[i++]); ) n += s(t);
                    return n;
                }),
            ((_ = T.selectors =
                {
                    cacheLength: 50,
                    createPseudo: ce,
                    match: J,
                    attrHandle: {},
                    find: {},
                    relative: {
                        ">": { dir: "parentNode", first: !0 },
                        " ": { dir: "parentNode" },
                        "+": { dir: "previousSibling", first: !0 },
                        "~": { dir: "previousSibling" },
                    },
                    preFilter: {
                        ATTR: function (e) {
                            return (
                                (e[1] = e[1].replace(re, h)),
                                (e[3] = (e[3] || e[4] || e[5] || "").replace(
                                    re,
                                    h
                                )),
                                "~=" === e[2] && (e[3] = " " + e[3] + " "),
                                e.slice(0, 4)
                            );
                        },
                        CHILD: function (e) {
                            return (
                                (e[1] = e[1].toLowerCase()),
                                "nth" === e[1].slice(0, 3)
                                    ? (e[3] || T.error(e[0]),
                                      (e[4] = +(e[4]
                                          ? e[5] + (e[6] || 1)
                                          : 2 *
                                            ("even" === e[3] ||
                                                "odd" === e[3]))),
                                      (e[5] = +(e[7] + e[8] || "odd" === e[3])))
                                    : e[3] && T.error(e[0]),
                                e
                            );
                        },
                        PSEUDO: function (e) {
                            var t,
                                n = !e[6] && e[2];
                            return J.CHILD.test(e[0])
                                ? null
                                : (e[3]
                                      ? (e[2] = e[4] || e[5] || "")
                                      : n &&
                                        G.test(n) &&
                                        (t = g(n, !0)) &&
                                        (t =
                                            n.indexOf(")", n.length - t) -
                                            n.length) &&
                                        ((e[0] = e[0].slice(0, t)),
                                        (e[2] = n.slice(0, t))),
                                  e.slice(0, 3));
                        },
                    },
                    filter: {
                        TAG: function (e) {
                            var t = e.replace(re, h).toLowerCase();
                            return "*" === e
                                ? function () {
                                      return !0;
                                  }
                                : function (e) {
                                      return (
                                          e.nodeName &&
                                          e.nodeName.toLowerCase() === t
                                      );
                                  };
                        },
                        CLASS: function (e) {
                            var t = D[e + " "];
                            return (
                                t ||
                                ((t = new RegExp(
                                    "(^|" + i + ")" + e + "(" + i + "|$)"
                                )) &&
                                    D(e, function (e) {
                                        return t.test(
                                            ("string" == typeof e.className &&
                                                e.className) ||
                                                (void 0 !== e.getAttribute &&
                                                    e.getAttribute("class")) ||
                                                ""
                                        );
                                    }))
                            );
                        },
                        ATTR: function (t, n, i) {
                            return function (e) {
                                e = T.attr(e, t);
                                return null == e
                                    ? "!=" === n
                                    : !n ||
                                          ((e += ""),
                                          "=" === n
                                              ? e === i
                                              : "!=" === n
                                              ? e !== i
                                              : "^=" === n
                                              ? i && 0 === e.indexOf(i)
                                              : "*=" === n
                                              ? i && -1 < e.indexOf(i)
                                              : "$=" === n
                                              ? i && e.slice(-i.length) === i
                                              : "~=" === n
                                              ? -1 <
                                                (
                                                    " " +
                                                    e.replace(U, " ") +
                                                    " "
                                                ).indexOf(i)
                                              : "|=" === n &&
                                                (e === i ||
                                                    e.slice(0, i.length + 1) ===
                                                        i + "-"));
                            };
                        },
                        CHILD: function (p, e, t, g, m) {
                            var v = "nth" !== p.slice(0, 3),
                                y = "last" !== p.slice(-4),
                                b = "of-type" === e;
                            return 1 === g && 0 === m
                                ? function (e) {
                                      return !!e.parentNode;
                                  }
                                : function (e, u, h) {
                                      var t,
                                          n,
                                          i,
                                          o,
                                          r,
                                          s,
                                          a =
                                              v != y
                                                  ? "nextSibling"
                                                  : "previousSibling",
                                          l = e.parentNode,
                                          d = b && e.nodeName.toLowerCase(),
                                          f = !h && !b,
                                          c = !1;
                                      if (l) {
                                          if (v) {
                                              for (; a; ) {
                                                  for (o = e; (o = o[a]); )
                                                      if (
                                                          b
                                                              ? o.nodeName.toLowerCase() ===
                                                                d
                                                              : 1 === o.nodeType
                                                      )
                                                          return !1;
                                                  s = a =
                                                      "only" === p &&
                                                      !s &&
                                                      "nextSibling";
                                              }
                                              return !0;
                                          }
                                          if (
                                              ((s = [
                                                  y
                                                      ? l.firstChild
                                                      : l.lastChild,
                                              ]),
                                              y && f)
                                          ) {
                                              for (
                                                  c =
                                                      (r =
                                                          (t =
                                                              (n =
                                                                  (i =
                                                                      (o = l)[
                                                                          E
                                                                      ] ||
                                                                      (o[E] =
                                                                          {}))[
                                                                      o.uniqueID
                                                                  ] ||
                                                                  (i[
                                                                      o.uniqueID
                                                                  ] = {}))[p] ||
                                                              [])[0] === S &&
                                                          t[1]) && t[2],
                                                      o = r && l.childNodes[r];
                                                  (o =
                                                      (++r && o && o[a]) ||
                                                      (c = r = 0) ||
                                                      s.pop());

                                              )
                                                  if (
                                                      1 === o.nodeType &&
                                                      ++c &&
                                                      o === e
                                                  ) {
                                                      n[p] = [S, r, c];
                                                      break;
                                                  }
                                          } else if (
                                              !1 ===
                                              (c = f
                                                  ? (r =
                                                        (t =
                                                            (n =
                                                                (i =
                                                                    (o = e)[
                                                                        E
                                                                    ] ||
                                                                    (o[E] =
                                                                        {}))[
                                                                    o.uniqueID
                                                                ] ||
                                                                (i[o.uniqueID] =
                                                                    {}))[p] ||
                                                            [])[0] === S &&
                                                        t[1])
                                                  : c)
                                          )
                                              for (
                                                  ;
                                                  (o =
                                                      (++r && o && o[a]) ||
                                                      (c = r = 0) ||
                                                      s.pop()) &&
                                                  ((b
                                                      ? o.nodeName.toLowerCase() !==
                                                        d
                                                      : 1 !== o.nodeType) ||
                                                      !++c ||
                                                      (f &&
                                                          ((n =
                                                              (i =
                                                                  o[E] ||
                                                                  (o[E] = {}))[
                                                                  o.uniqueID
                                                              ] ||
                                                              (i[o.uniqueID] =
                                                                  {}))[p] = [
                                                              S,
                                                              c,
                                                          ]),
                                                      o !== e));

                                              );
                                          return (
                                              (c -= m) === g ||
                                              (c % g == 0 && 0 <= c / g)
                                          );
                                      }
                                  };
                        },
                        PSEUDO: function (e, r) {
                            var t,
                                s =
                                    _.pseudos[e] ||
                                    _.setFilters[e.toLowerCase()] ||
                                    T.error("unsupported pseudo: " + e);
                            return s[E]
                                ? s(r)
                                : 1 < s.length
                                ? ((t = [e, e, "", r]),
                                  _.setFilters.hasOwnProperty(e.toLowerCase())
                                      ? ce(function (e, t) {
                                            for (
                                                var n,
                                                    i = s(e, r),
                                                    o = i.length;
                                                o--;

                                            )
                                                e[(n = B(e, i[o]))] = !(t[n] =
                                                    i[o]);
                                        })
                                      : function (e) {
                                            return s(e, 0, t);
                                        })
                                : s;
                        },
                    },
                    pseudos: {
                        not: ce(function (e) {
                            var i = [],
                                o = [],
                                a = m(e.replace(X, "$1"));
                            return a[E]
                                ? ce(function (e, t, n, i) {
                                      for (
                                          var o,
                                              r = a(e, null, i, []),
                                              s = e.length;
                                          s--;

                                      )
                                          (o = r[s]) && (e[s] = !(t[s] = o));
                                  })
                                : function (e, t, n) {
                                      return (
                                          (i[0] = e),
                                          a(i, null, n, o),
                                          (i[0] = null),
                                          !o.pop()
                                      );
                                  };
                        }),
                        has: ce(function (t) {
                            return function (e) {
                                return 0 < T(t, e).length;
                            };
                        }),
                        contains: ce(function (t) {
                            return (
                                (t = t.replace(re, h)),
                                function (e) {
                                    return (
                                        -1 < (e.textContent || s(e)).indexOf(t)
                                    );
                                }
                            );
                        }),
                        lang: ce(function (n) {
                            return (
                                K.test(n || "") ||
                                    T.error("unsupported lang: " + n),
                                (n = n.replace(re, h).toLowerCase()),
                                function (e) {
                                    var t;
                                    do {
                                        if (
                                            (t = x
                                                ? e.lang
                                                : e.getAttribute("xml:lang") ||
                                                  e.getAttribute("lang"))
                                        )
                                            return (
                                                (t = t.toLowerCase()) === n ||
                                                0 === t.indexOf(n + "-")
                                            );
                                    } while (
                                        (e = e.parentNode) &&
                                        1 === e.nodeType
                                    );
                                    return !1;
                                }
                            );
                        }),
                        target: function (e) {
                            var t = o.location && o.location.hash;
                            return t && t.slice(1) === e.id;
                        },
                        root: function (e) {
                            return e === n;
                        },
                        focus: function (e) {
                            return (
                                e === w.activeElement &&
                                (!w.hasFocus || w.hasFocus()) &&
                                !!(e.type || e.href || ~e.tabIndex)
                            );
                        },
                        enabled: fe(!1),
                        disabled: fe(!0),
                        checked: function (e) {
                            var t = e.nodeName.toLowerCase();
                            return (
                                ("input" === t && !!e.checked) ||
                                ("option" === t && !!e.selected)
                            );
                        },
                        selected: function (e) {
                            return (
                                e.parentNode && e.parentNode.selectedIndex,
                                !0 === e.selected
                            );
                        },
                        empty: function (e) {
                            for (e = e.firstChild; e; e = e.nextSibling)
                                if (e.nodeType < 6) return !1;
                            return !0;
                        },
                        parent: function (e) {
                            return !_.pseudos.empty(e);
                        },
                        header: function (e) {
                            return te.test(e.nodeName);
                        },
                        input: function (e) {
                            return ee.test(e.nodeName);
                        },
                        button: function (e) {
                            var t = e.nodeName.toLowerCase();
                            return (
                                ("input" === t && "button" === e.type) ||
                                "button" === t
                            );
                        },
                        text: function (e) {
                            return (
                                "input" === e.nodeName.toLowerCase() &&
                                "text" === e.type &&
                                (null == (e = e.getAttribute("type")) ||
                                    "text" === e.toLowerCase())
                            );
                        },
                        first: pe(function () {
                            return [0];
                        }),
                        last: pe(function (e, t) {
                            return [t - 1];
                        }),
                        eq: pe(function (e, t, n) {
                            return [n < 0 ? n + t : n];
                        }),
                        even: pe(function (e, t) {
                            for (var n = 0; n < t; n += 2) e.push(n);
                            return e;
                        }),
                        odd: pe(function (e, t) {
                            for (var n = 1; n < t; n += 2) e.push(n);
                            return e;
                        }),
                        lt: pe(function (e, t, n) {
                            for (
                                var i = n < 0 ? n + t : t < n ? t : n;
                                0 <= --i;

                            )
                                e.push(i);
                            return e;
                        }),
                        gt: pe(function (e, t, n) {
                            for (var i = n < 0 ? n + t : n; ++i < t; )
                                e.push(i);
                            return e;
                        }),
                    },
                }).pseudos.nth = _.pseudos.eq),
            { radio: !0, checkbox: !0, file: !0, password: !0, image: !0 }))
                _.pseudos[e] = (function (t) {
                    return function (e) {
                        return (
                            "input" === e.nodeName.toLowerCase() && e.type === t
                        );
                    };
                })(e);
            for (e in { submit: !0, reset: !0 })
                _.pseudos[e] = (function (n) {
                    return function (e) {
                        var t = e.nodeName.toLowerCase();
                        return (
                            ("input" === t || "button" === t) && e.type === n
                        );
                    };
                })(e);
            function me() {}
            function ve(e) {
                for (var t = 0, n = e.length, i = ""; t < n; t++)
                    i += e[t].value;
                return i;
            }
            function ye(s, e, t) {
                var a = e.dir,
                    l = e.next,
                    c = l || a,
                    u = t && "parentNode" === c,
                    h = L++;
                return e.first
                    ? function (e, t, n) {
                          for (; (e = e[a]); )
                              if (1 === e.nodeType || u) return s(e, t, n);
                          return !1;
                      }
                    : function (e, t, n) {
                          var i,
                              o,
                              r = [S, h];
                          if (n) {
                              for (; (e = e[a]); )
                                  if ((1 === e.nodeType || u) && s(e, t, n))
                                      return !0;
                          } else
                              for (; (e = e[a]); )
                                  if (1 === e.nodeType || u)
                                      if (
                                          ((o =
                                              (o = e[E] || (e[E] = {}))[
                                                  e.uniqueID
                                              ] || (o[e.uniqueID] = {})),
                                          l && l === e.nodeName.toLowerCase())
                                      )
                                          e = e[a] || e;
                                      else {
                                          if (
                                              (i = o[c]) &&
                                              i[0] === S &&
                                              i[1] === h
                                          )
                                              return (r[2] = i[2]);
                                          if (((o[c] = r)[2] = s(e, t, n)))
                                              return !0;
                                      }
                          return !1;
                      };
            }
            function be(o) {
                return 1 < o.length
                    ? function (e, t, n) {
                          for (var i = o.length; i--; )
                              if (!o[i](e, t, n)) return !1;
                          return !0;
                      }
                    : o[0];
            }
            function _e(e, t, n, i, o) {
                for (
                    var r, s = [], a = 0, l = e.length, c = null != t;
                    a < l;
                    a++
                )
                    (r = e[a]) &&
                        ((n && !n(r, i, o)) || (s.push(r), c && t.push(a)));
                return s;
            }
            function we(f, p, g, m, v, e) {
                return (
                    m && !m[E] && (m = we(m)),
                    v && !v[E] && (v = we(v, e)),
                    ce(function (e, t, n, i) {
                        var o,
                            r,
                            s,
                            u = [],
                            a = [],
                            h = t.length,
                            d =
                                e ||
                                (function (e, t, n) {
                                    for (var i = 0, o = t.length; i < o; i++)
                                        T(e, t[i], n);
                                    return n;
                                })(p || "*", n.nodeType ? [n] : n, []),
                            l = !f || (!e && p) ? d : _e(d, u, f, n, i),
                            c = g ? (v || (e ? f : h || m) ? [] : t) : l;
                        if ((g && g(l, c, n, i), m))
                            for (
                                o = _e(c, a), m(o, [], n, i), r = o.length;
                                r--;

                            )
                                (s = o[r]) && (c[a[r]] = !(l[a[r]] = s));
                        if (e) {
                            if (v || f) {
                                if (v) {
                                    for (o = [], r = c.length; r--; )
                                        (s = c[r]) && o.push((l[r] = s));
                                    v(null, (c = []), o, i);
                                }
                                for (r = c.length; r--; )
                                    (s = c[r]) &&
                                        -1 < (o = v ? B(e, s) : u[r]) &&
                                        (e[o] = !(t[o] = s));
                            }
                        } else (c = _e(c === t ? c.splice(h, c.length) : c)), v ? v(null, t, c, i) : q.apply(t, c);
                    })
                );
            }
            function xe(m, v) {
                function e(e, t, u, n, i) {
                    var o,
                        r,
                        s,
                        a = 0,
                        l = "0",
                        h = e && [],
                        c = [],
                        d = k,
                        f = e || (b && _.find.TAG("*", i)),
                        p = (S += null == d ? 1 : Math.random() || 0.1),
                        g = f.length;
                    for (
                        i && (k = t == w || t || i);
                        l !== g && null != (o = f[l]);
                        l++
                    ) {
                        if (b && o) {
                            for (
                                r = 0,
                                    t ||
                                        o.ownerDocument == w ||
                                        (C(o), (u = !x));
                                (s = m[r++]);

                            )
                                if (s(o, t || w, u)) {
                                    n.push(o);
                                    break;
                                }
                            i && (S = p);
                        }
                        y && ((o = !s && o) && a--, e && h.push(o));
                    }
                    if (((a += l), y && l !== a)) {
                        for (r = 0; (s = v[r++]); ) s(h, c, t, u);
                        if (e) {
                            if (0 < a)
                                for (; l--; )
                                    h[l] || c[l] || (c[l] = H.call(n));
                            c = _e(c);
                        }
                        q.apply(n, c),
                            i &&
                                !e &&
                                0 < c.length &&
                                1 < a + v.length &&
                                T.uniqueSort(n);
                    }
                    return i && ((S = p), (k = d)), h;
                }
                var y = 0 < v.length,
                    b = 0 < m.length;
                return y ? ce(e) : e;
            }
            return (
                (me.prototype = _.filters = _.pseudos),
                (_.setFilters = new me()),
                (g = T.tokenize =
                    function (e, t) {
                        var n,
                            i,
                            o,
                            r,
                            s,
                            a,
                            l,
                            c = N[e + " "];
                        if (c) return t ? 0 : c.slice(0);
                        for (s = e, a = [], l = _.preFilter; s; ) {
                            for (r in ((n && !(i = V.exec(s))) ||
                                (i && (s = s.slice(i[0].length) || s),
                                a.push((o = []))),
                            (n = !1),
                            (i = Y.exec(s)) &&
                                ((n = i.shift()),
                                o.push({
                                    value: n,
                                    type: i[0].replace(X, " "),
                                }),
                                (s = s.slice(n.length))),
                            _.filter))
                                !(i = J[r].exec(s)) ||
                                    (l[r] && !(i = l[r](i))) ||
                                    ((n = i.shift()),
                                    o.push({ value: n, type: r, matches: i }),
                                    (s = s.slice(n.length)));
                            if (!n) break;
                        }
                        return t ? s.length : s ? T.error(e) : N(e, a).slice(0);
                    }),
                (m = T.compile =
                    function (e, t) {
                        var n,
                            i = [],
                            o = [],
                            r = O[e + " "];
                        if (!r) {
                            for (n = (t = t || g(e)).length; n--; )
                                ((r = (function e(t) {
                                    for (
                                        var i,
                                            n,
                                            o,
                                            r = t.length,
                                            s = _.relative[t[0].type],
                                            a = s || _.relative[" "],
                                            l = s ? 1 : 0,
                                            u = ye(
                                                function (e) {
                                                    return e === i;
                                                },
                                                a,
                                                !0
                                            ),
                                            h = ye(
                                                function (e) {
                                                    return -1 < B(i, e);
                                                },
                                                a,
                                                !0
                                            ),
                                            c = [
                                                function (e, t, n) {
                                                    return (
                                                        (e =
                                                            (!s &&
                                                                (n ||
                                                                    t !== k)) ||
                                                            ((i = t).nodeType
                                                                ? u
                                                                : h)(e, t, n)),
                                                        (i = null),
                                                        e
                                                    );
                                                },
                                            ];
                                        l < r;
                                        l++
                                    )
                                        if ((n = _.relative[t[l].type]))
                                            c = [ye(be(c), n)];
                                        else {
                                            if (
                                                (n = _.filter[t[l].type].apply(
                                                    null,
                                                    t[l].matches
                                                ))[E]
                                            ) {
                                                for (
                                                    o = ++l;
                                                    o < r &&
                                                    !_.relative[t[o].type];
                                                    o++
                                                );
                                                return we(
                                                    1 < l && be(c),
                                                    1 < l &&
                                                        ve(
                                                            t
                                                                .slice(0, l - 1)
                                                                .concat({
                                                                    value:
                                                                        " " ===
                                                                        t[l - 2]
                                                                            .type
                                                                            ? "*"
                                                                            : "",
                                                                })
                                                        ).replace(X, "$1"),
                                                    n,
                                                    l < o && e(t.slice(l, o)),
                                                    o < r &&
                                                        e((t = t.slice(o))),
                                                    o < r && ve(t)
                                                );
                                            }
                                            c.push(n);
                                        }
                                    return be(c);
                                })(t[n]))[E]
                                    ? i
                                    : o
                                ).push(r);
                            (r = O(e, xe(o, i))).selector = e;
                        }
                        return r;
                    }),
                (v = T.select =
                    function (e, t, n, i) {
                        var o,
                            r,
                            s,
                            a,
                            u,
                            l = "function" == typeof e && e,
                            c = !i && g((e = l.selector || e));
                        if (((n = n || []), 1 === c.length)) {
                            if (
                                2 < (r = c[0] = c[0].slice(0)).length &&
                                "ID" === (s = r[0]).type &&
                                9 === t.nodeType &&
                                x &&
                                _.relative[r[1].type]
                            ) {
                                if (
                                    !(t = (_.find.ID(
                                        s.matches[0].replace(re, h),
                                        t
                                    ) || [])[0])
                                )
                                    return n;
                                l && (t = t.parentNode),
                                    (e = e.slice(r.shift().value.length));
                            }
                            for (
                                o = J.needsContext.test(e) ? 0 : r.length;
                                o-- && ((s = r[o]), !_.relative[(a = s.type)]);

                            )
                                if (
                                    (u = _.find[a]) &&
                                    (i = u(
                                        s.matches[0].replace(re, h),
                                        (oe.test(r[0].type) &&
                                            ge(t.parentNode)) ||
                                            t
                                    ))
                                ) {
                                    if (
                                        (r.splice(o, 1),
                                        !(e = i.length && ve(r)))
                                    )
                                        return q.apply(n, i), n;
                                    break;
                                }
                        }
                        return (
                            (l || m(e, c))(
                                i,
                                t,
                                !x,
                                n,
                                !t || (oe.test(e) && ge(t.parentNode)) || t
                            ),
                            n
                        );
                    }),
                (d.sortStable = E.split("").sort(I).join("") === E),
                (d.detectDuplicates = !!u),
                C(),
                (d.sortDetached = ue(function (e) {
                    return (
                        1 &
                        e.compareDocumentPosition(w.createElement("fieldset"))
                    );
                })),
                ue(function (e) {
                    return (
                        (e.innerHTML = "<a href='#'></a>"),
                        "#" === e.firstChild.getAttribute("href")
                    );
                }) ||
                    he("type|href|height|width", function (e, t, n) {
                        if (!n)
                            return e.getAttribute(
                                t,
                                "type" === t.toLowerCase() ? 1 : 2
                            );
                    }),
                (d.attributes &&
                    ue(function (e) {
                        return (
                            (e.innerHTML = "<input/>"),
                            e.firstChild.setAttribute("value", ""),
                            "" === e.firstChild.getAttribute("value")
                        );
                    })) ||
                    he("value", function (e, t, n) {
                        if (!n && "input" === e.nodeName.toLowerCase())
                            return e.defaultValue;
                    }),
                ue(function (e) {
                    return null == e.getAttribute("disabled");
                }) ||
                    he(W, function (e, t, n) {
                        if (!n)
                            return !0 === e[t]
                                ? t.toLowerCase()
                                : (n = e.getAttributeNode(t)) && n.specified
                                ? n.value
                                : null;
                    }),
                T
            );
        })(w),
        L =
            ((E.find = e),
            (E.expr = e.selectors),
            (E.expr[":"] = E.expr.pseudos),
            (E.uniqueSort = E.unique = e.uniqueSort),
            (E.text = e.getText),
            (E.isXMLDoc = e.isXML),
            (E.contains = e.contains),
            (E.escapeSelector = e.escape),
            E.expr.match.needsContext);
    function l(e, t) {
        return e.nodeName && e.nodeName.toLowerCase() === t.toLowerCase();
    }
    var D = /^<([a-z][^\/\0>:\x20\t\r\n\f]*)[\x20\t\r\n\f]*\/?>(?:<\/\1>|)$/i;
    function N(e, n, i) {
        return y(n)
            ? E.grep(e, function (e, t) {
                  return !!n.call(e, t, e) !== i;
              })
            : n.nodeType
            ? E.grep(e, function (e) {
                  return (e === n) !== i;
              })
            : "string" != typeof n
            ? E.grep(e, function (e) {
                  return -1 < o.call(n, e) !== i;
              })
            : E.filter(n, e, i);
    }
    (E.filter = function (e, t, n) {
        var i = t[0];
        return (
            n && (e = ":not(" + e + ")"),
            1 === t.length && 1 === i.nodeType
                ? E.find.matchesSelector(i, e)
                    ? [i]
                    : []
                : E.find.matches(
                      e,
                      E.grep(t, function (e) {
                          return 1 === e.nodeType;
                      })
                  )
        );
    }),
        E.fn.extend({
            find: function (e) {
                var t,
                    n,
                    i = this.length,
                    o = this;
                if ("string" != typeof e)
                    return this.pushStack(
                        E(e).filter(function () {
                            for (t = 0; t < i; t++)
                                if (E.contains(o[t], this)) return !0;
                        })
                    );
                for (n = this.pushStack([]), t = 0; t < i; t++)
                    E.find(e, o[t], n);
                return 1 < i ? E.uniqueSort(n) : n;
            },
            filter: function (e) {
                return this.pushStack(N(this, e || [], !1));
            },
            not: function (e) {
                return this.pushStack(N(this, e || [], !0));
            },
            is: function (e) {
                return !!N(
                    this,
                    "string" == typeof e && L.test(e) ? E(e) : e || [],
                    !1
                ).length;
            },
        });
    var O,
        j = /^(?:\s*(<[\w\W]+>)[^>]*|#([\w-]+))$/,
        I =
            (((E.fn.init = function (e, t, n) {
                if (!e) return this;
                if (((n = n || O), "string" != typeof e))
                    return e.nodeType
                        ? ((this[0] = e), (this.length = 1), this)
                        : y(e)
                        ? void 0 !== n.ready
                            ? n.ready(e)
                            : e(E)
                        : E.makeArray(e, this);
                if (
                    !(i =
                        "<" === e[0] && ">" === e[e.length - 1] && 3 <= e.length
                            ? [null, e, null]
                            : j.exec(e)) ||
                    (!i[1] && t)
                )
                    return (!t || t.jquery ? t || n : this.constructor(t)).find(
                        e
                    );
                if (i[1]) {
                    if (
                        ((t = t instanceof E ? t[0] : t),
                        E.merge(
                            this,
                            E.parseHTML(
                                i[1],
                                t && t.nodeType ? t.ownerDocument || t : x,
                                !0
                            )
                        ),
                        D.test(i[1]) && E.isPlainObject(t))
                    )
                        for (var i in t)
                            y(this[i]) ? this[i](t[i]) : this.attr(i, t[i]);
                    return this;
                }
                return (
                    (n = x.getElementById(i[2])) &&
                        ((this[0] = n), (this.length = 1)),
                    this
                );
            }).prototype = E.fn),
            (O = E(x)),
            /^(?:parents|prev(?:Until|All))/),
        P = { children: !0, contents: !0, next: !0, prev: !0 };
    function H(e, t) {
        for (; (e = e[t]) && 1 !== e.nodeType; );
        return e;
    }
    E.fn.extend({
        has: function (e) {
            var t = E(e, this),
                n = t.length;
            return this.filter(function () {
                for (var e = 0; e < n; e++)
                    if (E.contains(this, t[e])) return !0;
            });
        },
        closest: function (e, t) {
            var n,
                i = 0,
                o = this.length,
                r = [],
                s = "string" != typeof e && E(e);
            if (!L.test(e))
                for (; i < o; i++)
                    for (n = this[i]; n && n !== t; n = n.parentNode)
                        if (
                            n.nodeType < 11 &&
                            (s
                                ? -1 < s.index(n)
                                : 1 === n.nodeType &&
                                  E.find.matchesSelector(n, e))
                        ) {
                            r.push(n);
                            break;
                        }
            return this.pushStack(1 < r.length ? E.uniqueSort(r) : r);
        },
        index: function (e) {
            return e
                ? "string" == typeof e
                    ? o.call(E(e), this[0])
                    : o.call(this, e.jquery ? e[0] : e)
                : this[0] && this[0].parentNode
                ? this.first().prevAll().length
                : -1;
        },
        add: function (e, t) {
            return this.pushStack(E.uniqueSort(E.merge(this.get(), E(e, t))));
        },
        addBack: function (e) {
            return this.add(
                null == e ? this.prevObject : this.prevObject.filter(e)
            );
        },
    }),
        E.each(
            {
                parent: function (e) {
                    e = e.parentNode;
                    return e && 11 !== e.nodeType ? e : null;
                },
                parents: function (e) {
                    return A(e, "parentNode");
                },
                parentsUntil: function (e, t, n) {
                    return A(e, "parentNode", n);
                },
                next: function (e) {
                    return H(e, "nextSibling");
                },
                prev: function (e) {
                    return H(e, "previousSibling");
                },
                nextAll: function (e) {
                    return A(e, "nextSibling");
                },
                prevAll: function (e) {
                    return A(e, "previousSibling");
                },
                nextUntil: function (e, t, n) {
                    return A(e, "nextSibling", n);
                },
                prevUntil: function (e, t, n) {
                    return A(e, "previousSibling", n);
                },
                siblings: function (e) {
                    return S((e.parentNode || {}).firstChild, e);
                },
                children: function (e) {
                    return S(e.firstChild);
                },
                contents: function (e) {
                    return null != e.contentDocument && i(e.contentDocument)
                        ? e.contentDocument
                        : (l(e, "template") && (e = e.content || e),
                          E.merge([], e.childNodes));
                },
            },
            function (i, o) {
                E.fn[i] = function (e, t) {
                    var n = E.map(this, o, e);
                    return (
                        (t = "Until" !== i.slice(-5) ? e : t) &&
                            "string" == typeof t &&
                            (n = E.filter(t, n)),
                        1 < this.length &&
                            (P[i] || E.uniqueSort(n), I.test(i) && n.reverse()),
                        this.pushStack(n)
                    );
                };
            }
        );
    var M = /[^\x20\t\r\n\f]+/g;
    function q(e) {
        return e;
    }
    function R(e) {
        throw e;
    }
    function B(e, t, n, i) {
        var o;
        try {
            e && y((o = e.promise))
                ? o.call(e).done(t).fail(n)
                : e && y((o = e.then))
                ? o.call(e, t, n)
                : t.apply(void 0, [e].slice(i));
        } catch (e) {
            n.apply(void 0, [e]);
        }
    }
    (E.Callbacks = function (i) {
        var e, n;
        i =
            "string" == typeof i
                ? ((e = i),
                  (n = {}),
                  E.each(e.match(M) || [], function (e, t) {
                      n[t] = !0;
                  }),
                  n)
                : E.extend({}, i);
        function u() {
            for (r = r || i.once, h = o = !0; a.length; l = -1)
                for (t = a.shift(); ++l < s.length; )
                    !1 === s[l].apply(t[0], t[1]) &&
                        i.stopOnFalse &&
                        ((l = s.length), (t = !1));
            i.memory || (t = !1), (o = !1), r && (s = t ? [] : "");
        }
        var o,
            t,
            h,
            r,
            s = [],
            a = [],
            l = -1,
            c = {
                add: function () {
                    return (
                        s &&
                            (t && !o && ((l = s.length - 1), a.push(t)),
                            (function n(e) {
                                E.each(e, function (e, t) {
                                    y(t)
                                        ? (i.unique && c.has(t)) || s.push(t)
                                        : t &&
                                          t.length &&
                                          "string" !== p(t) &&
                                          n(t);
                                });
                            })(arguments),
                            t && !o && u()),
                        this
                    );
                },
                remove: function () {
                    return (
                        E.each(arguments, function (e, t) {
                            for (var n; -1 < (n = E.inArray(t, s, n)); )
                                s.splice(n, 1), n <= l && l--;
                        }),
                        this
                    );
                },
                has: function (e) {
                    return e ? -1 < E.inArray(e, s) : 0 < s.length;
                },
                empty: function () {
                    return (s = s && []), this;
                },
                disable: function () {
                    return (r = a = []), (s = t = ""), this;
                },
                disabled: function () {
                    return !s;
                },
                lock: function () {
                    return (r = a = []), t || o || (s = t = ""), this;
                },
                locked: function () {
                    return !!r;
                },
                fireWith: function (e, t) {
                    return (
                        r ||
                            ((t = [e, (t = t || []).slice ? t.slice() : t]),
                            a.push(t),
                            o || u()),
                        this
                    );
                },
                fire: function () {
                    return c.fireWith(this, arguments), this;
                },
                fired: function () {
                    return !!h;
                },
            };
        return c;
    }),
        E.extend({
            Deferred: function (e) {
                var r = [
                        [
                            "notify",
                            "progress",
                            E.Callbacks("memory"),
                            E.Callbacks("memory"),
                            2,
                        ],
                        [
                            "resolve",
                            "done",
                            E.Callbacks("once memory"),
                            E.Callbacks("once memory"),
                            0,
                            "resolved",
                        ],
                        [
                            "reject",
                            "fail",
                            E.Callbacks("once memory"),
                            E.Callbacks("once memory"),
                            1,
                            "rejected",
                        ],
                    ],
                    o = "pending",
                    s = {
                        state: function () {
                            return o;
                        },
                        always: function () {
                            return a.done(arguments).fail(arguments), this;
                        },
                        catch: function (e) {
                            return s.then(null, e);
                        },
                        pipe: function () {
                            var o = arguments;
                            return E.Deferred(function (i) {
                                E.each(r, function (e, t) {
                                    var n = y(o[t[4]]) && o[t[4]];
                                    a[t[1]](function () {
                                        var e = n && n.apply(this, arguments);
                                        e && y(e.promise)
                                            ? e
                                                  .promise()
                                                  .progress(i.notify)
                                                  .done(i.resolve)
                                                  .fail(i.reject)
                                            : i[t[0] + "With"](
                                                  this,
                                                  n ? [e] : arguments
                                              );
                                    });
                                }),
                                    (o = null);
                            }).promise();
                        },
                        then: function (t, n, i) {
                            var l = 0;
                            function c(o, r, s, a) {
                                return function () {
                                    function e() {
                                        var e, t;
                                        if (!(o < l)) {
                                            if (
                                                (e = s.apply(n, i)) ===
                                                r.promise()
                                            )
                                                throw new TypeError(
                                                    "Thenable self-resolution"
                                                );
                                            (t =
                                                e &&
                                                ("object" == typeof e ||
                                                    "function" == typeof e) &&
                                                e.then),
                                                y(t)
                                                    ? a
                                                        ? t.call(
                                                              e,
                                                              c(l, r, q, a),
                                                              c(l, r, R, a)
                                                          )
                                                        : (l++,
                                                          t.call(
                                                              e,
                                                              c(l, r, q, a),
                                                              c(l, r, R, a),
                                                              c(
                                                                  l,
                                                                  r,
                                                                  q,
                                                                  r.notifyWith
                                                              )
                                                          ))
                                                    : (s !== q &&
                                                          ((n = void 0),
                                                          (i = [e])),
                                                      (a || r.resolveWith)(
                                                          n,
                                                          i
                                                      ));
                                        }
                                    }
                                    var n = this,
                                        i = arguments,
                                        t = a
                                            ? e
                                            : function () {
                                                  try {
                                                      e();
                                                  } catch (e) {
                                                      E.Deferred
                                                          .exceptionHook &&
                                                          E.Deferred.exceptionHook(
                                                              e,
                                                              t.stackTrace
                                                          ),
                                                          l <= o + 1 &&
                                                              (s !== R &&
                                                                  ((n = void 0),
                                                                  (i = [e])),
                                                              r.rejectWith(
                                                                  n,
                                                                  i
                                                              ));
                                                  }
                                              };
                                    o
                                        ? t()
                                        : (E.Deferred.getStackHook &&
                                              (t.stackTrace =
                                                  E.Deferred.getStackHook()),
                                          w.setTimeout(t));
                                };
                            }
                            return E.Deferred(function (e) {
                                r[0][3].add(
                                    c(0, e, y(i) ? i : q, e.notifyWith)
                                ),
                                    r[1][3].add(c(0, e, y(t) ? t : q)),
                                    r[2][3].add(c(0, e, y(n) ? n : R));
                            }).promise();
                        },
                        promise: function (e) {
                            return null != e ? E.extend(e, s) : s;
                        },
                    },
                    a = {};
                return (
                    E.each(r, function (e, t) {
                        var n = t[2],
                            i = t[5];
                        (s[t[1]] = n.add),
                            i &&
                                n.add(
                                    function () {
                                        o = i;
                                    },
                                    r[3 - e][2].disable,
                                    r[3 - e][3].disable,
                                    r[0][2].lock,
                                    r[0][3].lock
                                ),
                            n.add(t[3].fire),
                            (a[t[0]] = function () {
                                return (
                                    a[t[0] + "With"](
                                        this === a ? void 0 : this,
                                        arguments
                                    ),
                                    this
                                );
                            }),
                            (a[t[0] + "With"] = n.fireWith);
                    }),
                    s.promise(a),
                    e && e.call(a, a),
                    a
                );
            },
            when: function (e) {
                function t(t) {
                    return function (e) {
                        (o[t] = this),
                            (r[t] =
                                1 < arguments.length ? c.call(arguments) : e),
                            --n || s.resolveWith(o, r);
                    };
                }
                var n = arguments.length,
                    i = n,
                    o = Array(i),
                    r = c.call(arguments),
                    s = E.Deferred();
                if (
                    n <= 1 &&
                    (B(e, s.done(t(i)).resolve, s.reject, !n),
                    "pending" === s.state() || y(r[i] && r[i].then))
                )
                    return s.then();
                for (; i--; ) B(r[i], t(i), s.reject);
                return s.promise();
            },
        });
    var W = /^(Eval|Internal|Range|Reference|Syntax|Type|URI)Error$/,
        F =
            ((E.Deferred.exceptionHook = function (e, t) {
                w.console &&
                    w.console.warn &&
                    e &&
                    W.test(e.name) &&
                    w.console.warn(
                        "jQuery.Deferred exception: " + e.message,
                        e.stack,
                        t
                    );
            }),
            (E.readyException = function (e) {
                w.setTimeout(function () {
                    throw e;
                });
            }),
            E.Deferred());
    function z() {
        x.removeEventListener("DOMContentLoaded", z),
            w.removeEventListener("load", z),
            E.ready();
    }
    (E.fn.ready = function (e) {
        return (
            F.then(e).catch(function (e) {
                E.readyException(e);
            }),
            this
        );
    }),
        E.extend({
            isReady: !1,
            readyWait: 1,
            ready: function (e) {
                (!0 === e ? --E.readyWait : E.isReady) ||
                    ((E.isReady = !0) !== e && 0 < --E.readyWait) ||
                    F.resolveWith(x, [E]);
            },
        }),
        (E.ready.then = F.then),
        "complete" === x.readyState ||
        ("loading" !== x.readyState && !x.documentElement.doScroll)
            ? w.setTimeout(E.ready)
            : (x.addEventListener("DOMContentLoaded", z),
              w.addEventListener("load", z));
    function $(e, t, n, i, o, r, s) {
        var a = 0,
            l = e.length,
            c = null == n;
        if ("object" === p(n))
            for (a in ((o = !0), n)) $(e, t, a, n[a], !0, r, s);
        else if (
            void 0 !== i &&
            ((o = !0),
            y(i) || (s = !0),
            (t = c
                ? s
                    ? (t.call(e, i), null)
                    : ((c = t),
                      function (e, t, n) {
                          return c.call(E(e), n);
                      })
                : t))
        )
            for (; a < l; a++) t(e[a], n, s ? i : i.call(e[a], a, t(e[a], n)));
        return o ? e : c ? t.call(e) : l ? t(e[0], n) : r;
    }
    var U = /^-ms-/,
        X = /-([a-z])/g;
    function V(e, t) {
        return t.toUpperCase();
    }
    function Y(e) {
        return e.replace(U, "ms-").replace(X, V);
    }
    function Q(e) {
        return 1 === e.nodeType || 9 === e.nodeType || !+e.nodeType;
    }
    function G() {
        this.expando = E.expando + G.uid++;
    }
    (G.uid = 1),
        (G.prototype = {
            cache: function (e) {
                var t = e[this.expando];
                return (
                    t ||
                        ((t = {}),
                        Q(e) &&
                            (e.nodeType
                                ? (e[this.expando] = t)
                                : Object.defineProperty(e, this.expando, {
                                      value: t,
                                      configurable: !0,
                                  }))),
                    t
                );
            },
            set: function (e, t, n) {
                var i,
                    o = this.cache(e);
                if ("string" == typeof t) o[Y(t)] = n;
                else for (i in t) o[Y(i)] = t[i];
                return o;
            },
            get: function (e, t) {
                return void 0 === t
                    ? this.cache(e)
                    : e[this.expando] && e[this.expando][Y(t)];
            },
            access: function (e, t, n) {
                return void 0 === t ||
                    (t && "string" == typeof t && void 0 === n)
                    ? this.get(e, t)
                    : (this.set(e, t, n), void 0 !== n ? n : t);
            },
            remove: function (e, t) {
                var n,
                    i = e[this.expando];
                if (void 0 !== i) {
                    if (void 0 !== t) {
                        n = (t = Array.isArray(t)
                            ? t.map(Y)
                            : (t = Y(t)) in i
                            ? [t]
                            : t.match(M) || []).length;
                        for (; n--; ) delete i[t[n]];
                    }
                    (void 0 !== t && !E.isEmptyObject(i)) ||
                        (e.nodeType
                            ? (e[this.expando] = void 0)
                            : delete e[this.expando]);
                }
            },
            hasData: function (e) {
                e = e[this.expando];
                return void 0 !== e && !E.isEmptyObject(e);
            },
        });
    var v = new G(),
        a = new G(),
        K = /^(?:\{[\w\W]*\}|\[[\w\W]*\])$/,
        J = /[A-Z]/g;
    function Z(e, t, n) {
        var i, o;
        if (void 0 === n && 1 === e.nodeType)
            if (
                ((i = "data-" + t.replace(J, "-$&").toLowerCase()),
                "string" == typeof (n = e.getAttribute(i)))
            ) {
                try {
                    n =
                        "true" === (o = n) ||
                        ("false" !== o &&
                            ("null" === o
                                ? null
                                : o === +o + ""
                                ? +o
                                : K.test(o)
                                ? JSON.parse(o)
                                : o));
                } catch (e) {}
                a.set(e, t, n);
            } else n = void 0;
        return n;
    }
    E.extend({
        hasData: function (e) {
            return a.hasData(e) || v.hasData(e);
        },
        data: function (e, t, n) {
            return a.access(e, t, n);
        },
        removeData: function (e, t) {
            a.remove(e, t);
        },
        _data: function (e, t, n) {
            return v.access(e, t, n);
        },
        _removeData: function (e, t) {
            v.remove(e, t);
        },
    }),
        E.fn.extend({
            data: function (n, e) {
                var t,
                    i,
                    o,
                    r = this[0],
                    s = r && r.attributes;
                if (void 0 !== n)
                    return "object" == typeof n
                        ? this.each(function () {
                              a.set(this, n);
                          })
                        : $(
                              this,
                              function (e) {
                                  var t;
                                  if (r && void 0 === e)
                                      return void 0 !== (t = a.get(r, n)) ||
                                          void 0 !== (t = Z(r, n))
                                          ? t
                                          : void 0;
                                  this.each(function () {
                                      a.set(this, n, e);
                                  });
                              },
                              null,
                              e,
                              1 < arguments.length,
                              null,
                              !0
                          );
                if (
                    this.length &&
                    ((o = a.get(r)),
                    1 === r.nodeType && !v.get(r, "hasDataAttrs"))
                ) {
                    for (t = s.length; t--; )
                        s[t] &&
                            0 === (i = s[t].name).indexOf("data-") &&
                            ((i = Y(i.slice(5))), Z(r, i, o[i]));
                    v.set(r, "hasDataAttrs", !0);
                }
                return o;
            },
            removeData: function (e) {
                return this.each(function () {
                    a.remove(this, e);
                });
            },
        }),
        E.extend({
            queue: function (e, t, n) {
                var i;
                if (e)
                    return (
                        (i = v.get(e, (t = (t || "fx") + "queue"))),
                        n &&
                            (!i || Array.isArray(n)
                                ? (i = v.access(e, t, E.makeArray(n)))
                                : i.push(n)),
                        i || []
                    );
            },
            dequeue: function (e, t) {
                t = t || "fx";
                var n = E.queue(e, t),
                    i = n.length,
                    o = n.shift(),
                    r = E._queueHooks(e, t);
                "inprogress" === o && ((o = n.shift()), i--),
                    o &&
                        ("fx" === t && n.unshift("inprogress"),
                        delete r.stop,
                        o.call(
                            e,
                            function () {
                                E.dequeue(e, t);
                            },
                            r
                        )),
                    !i && r && r.empty.fire();
            },
            _queueHooks: function (e, t) {
                var n = t + "queueHooks";
                return (
                    v.get(e, n) ||
                    v.access(e, n, {
                        empty: E.Callbacks("once memory").add(function () {
                            v.remove(e, [t + "queue", n]);
                        }),
                    })
                );
            },
        }),
        E.fn.extend({
            queue: function (t, n) {
                var e = 2;
                return (
                    "string" != typeof t && ((n = t), (t = "fx"), e--),
                    arguments.length < e
                        ? E.queue(this[0], t)
                        : void 0 === n
                        ? this
                        : this.each(function () {
                              var e = E.queue(this, t, n);
                              E._queueHooks(this, t),
                                  "fx" === t &&
                                      "inprogress" !== e[0] &&
                                      E.dequeue(this, t);
                          })
                );
            },
            dequeue: function (e) {
                return this.each(function () {
                    E.dequeue(this, e);
                });
            },
            clearQueue: function (e) {
                return this.queue(e || "fx", []);
            },
            promise: function (e, t) {
                function n() {
                    --o || r.resolveWith(s, [s]);
                }
                var i,
                    o = 1,
                    r = E.Deferred(),
                    s = this,
                    a = this.length;
                for (
                    "string" != typeof e && ((t = e), (e = void 0)),
                        e = e || "fx";
                    a--;

                )
                    (i = v.get(s[a], e + "queueHooks")) &&
                        i.empty &&
                        (o++, i.empty.add(n));
                return n(), r.promise(t);
            },
        });
    function ee(e, t) {
        return (
            "none" === (e = t || e).style.display ||
            ("" === e.style.display && oe(e) && "none" === E.css(e, "display"))
        );
    }
    var e = /[+-]?(?:\d*\.|)\d+(?:[eE][+-]?\d+|)/.source,
        te = new RegExp("^(?:([+-])=|)(" + e + ")([a-z%]*)$", "i"),
        ne = ["Top", "Right", "Bottom", "Left"],
        ie = x.documentElement,
        oe = function (e) {
            return E.contains(e.ownerDocument, e);
        },
        re = { composed: !0 };
    ie.getRootNode &&
        (oe = function (e) {
            return (
                E.contains(e.ownerDocument, e) ||
                e.getRootNode(re) === e.ownerDocument
            );
        });
    function se(e, t, n, i) {
        var o,
            r,
            s = 20,
            u = i
                ? function () {
                      return i.cur();
                  }
                : function () {
                      return E.css(e, t, "");
                  },
            a = u(),
            l = (n && n[3]) || (E.cssNumber[t] ? "" : "px"),
            c =
                e.nodeType &&
                (E.cssNumber[t] || ("px" !== l && +a)) &&
                te.exec(E.css(e, t));
        if (c && c[3] !== l) {
            for (l = l || c[3], c = +(a /= 2) || 1; s--; )
                E.style(e, t, c + l),
                    (1 - r) * (1 - (r = u() / a || 0.5)) <= 0 && (s = 0),
                    (c /= r);
            E.style(e, t, (c *= 2) + l), (n = n || []);
        }
        return (
            n &&
                ((c = +c || +a || 0),
                (o = n[1] ? c + (n[1] + 1) * n[2] : +n[2]),
                i && ((i.unit = l), (i.start = c), (i.end = o))),
            o
        );
    }
    var ae = {};
    function le(e, t) {
        for (var n, i, o, r, s, a = [], l = 0, c = e.length; l < c; l++)
            (i = e[l]).style &&
                ((n = i.style.display),
                t
                    ? ("none" === n &&
                          ((a[l] = v.get(i, "display") || null),
                          a[l] || (i.style.display = "")),
                      "" === i.style.display &&
                          ee(i) &&
                          (a[l] =
                              ((s = r = void 0),
                              (r = (o = i).ownerDocument),
                              (o = o.nodeName),
                              (s = ae[o]) ||
                                  ((r = r.body.appendChild(r.createElement(o))),
                                  (s = E.css(r, "display")),
                                  r.parentNode.removeChild(r),
                                  (ae[o] = s = "none" === s ? "block" : s)))))
                    : "none" !== n &&
                      ((a[l] = "none"), v.set(i, "display", n)));
        for (l = 0; l < c; l++) null != a[l] && (e[l].style.display = a[l]);
        return e;
    }
    E.fn.extend({
        show: function () {
            return le(this, !0);
        },
        hide: function () {
            return le(this);
        },
        toggle: function (e) {
            return "boolean" == typeof e
                ? e
                    ? this.show()
                    : this.hide()
                : this.each(function () {
                      ee(this) ? E(this).show() : E(this).hide();
                  });
        },
    });
    var ce = /^(?:checkbox|radio)$/i,
        ue = /<([a-z][^\/\0>\x20\t\r\n\f]*)/i,
        he = /^$|^module$|\/(?:java|ecma)script/i,
        de =
            ((lt = x
                .createDocumentFragment()
                .appendChild(x.createElement("div"))),
            (at = x.createElement("input")).setAttribute("type", "radio"),
            at.setAttribute("checked", "checked"),
            at.setAttribute("name", "t"),
            lt.appendChild(at),
            (g.checkClone = lt.cloneNode(!0).cloneNode(!0).lastChild.checked),
            (lt.innerHTML = "<textarea>x</textarea>"),
            (g.noCloneChecked = !!lt.cloneNode(!0).lastChild.defaultValue),
            (lt.innerHTML = "<option></option>"),
            (g.option = !!lt.lastChild),
            {
                thead: [1, "<table>", "</table>"],
                col: [2, "<table><colgroup>", "</colgroup></table>"],
                tr: [2, "<table><tbody>", "</tbody></table>"],
                td: [3, "<table><tbody><tr>", "</tr></tbody></table>"],
                _default: [0, "", ""],
            });
    function m(e, t) {
        var n =
            void 0 !== e.getElementsByTagName
                ? e.getElementsByTagName(t || "*")
                : void 0 !== e.querySelectorAll
                ? e.querySelectorAll(t || "*")
                : [];
        return void 0 === t || (t && l(e, t)) ? E.merge([e], n) : n;
    }
    function fe(e, t) {
        for (var n = 0, i = e.length; n < i; n++)
            v.set(e[n], "globalEval", !t || v.get(t[n], "globalEval"));
    }
    (de.tbody = de.tfoot = de.colgroup = de.caption = de.thead),
        (de.th = de.td),
        g.option ||
            (de.optgroup = de.option =
                [1, "<select multiple='multiple'>", "</select>"]);
    var pe = /<|&#?\w+;/;
    function ge(e, t, n, u, h) {
        for (
            var i,
                o,
                r,
                d,
                s,
                a = t.createDocumentFragment(),
                l = [],
                c = 0,
                f = e.length;
            c < f;
            c++
        )
            if ((i = e[c]) || 0 === i)
                if ("object" === p(i)) E.merge(l, i.nodeType ? [i] : i);
                else if (pe.test(i)) {
                    for (
                        o = o || a.appendChild(t.createElement("div")),
                            r = (ue.exec(i) || ["", ""])[1].toLowerCase(),
                            r = de[r] || de._default,
                            o.innerHTML = r[1] + E.htmlPrefilter(i) + r[2],
                            s = r[0];
                        s--;

                    )
                        o = o.lastChild;
                    E.merge(l, o.childNodes),
                        ((o = a.firstChild).textContent = "");
                } else l.push(t.createTextNode(i));
        for (a.textContent = "", c = 0; (i = l[c++]); )
            if (u && -1 < E.inArray(i, u)) h && h.push(i);
            else if (
                ((d = oe(i)),
                (o = m(a.appendChild(i), "script")),
                d && fe(o),
                n)
            )
                for (s = 0; (i = o[s++]); ) he.test(i.type || "") && n.push(i);
        return a;
    }
    var me = /^([^.]*)(?:\.(.+)|)/;
    function ve() {
        return !0;
    }
    function ye() {
        return !1;
    }
    function be(e, t) {
        return (
            (e ===
                (function () {
                    try {
                        return x.activeElement;
                    } catch (e) {}
                })()) ==
            ("focus" === t)
        );
    }
    function _e(e, t, n, i, o, r) {
        var s, a;
        if ("object" == typeof t) {
            for (a in ("string" != typeof n && ((i = i || n), (n = void 0)), t))
                _e(e, a, n, i, t[a], r);
            return e;
        }
        if (
            (null == i && null == o
                ? ((o = n), (i = n = void 0))
                : null == o &&
                  ("string" == typeof n
                      ? ((o = i), (i = void 0))
                      : ((o = i), (i = n), (n = void 0))),
            !1 === o)
        )
            o = ye;
        else if (!o) return e;
        return (
            1 === r &&
                ((s = o),
                ((o = function (e) {
                    return E().off(e), s.apply(this, arguments);
                }).guid = s.guid || (s.guid = E.guid++))),
            e.each(function () {
                E.event.add(this, t, o, i, n);
            })
        );
    }
    function we(e, o, r) {
        r
            ? (v.set(e, o, !1),
              E.event.add(e, o, {
                  namespace: !1,
                  handler: function (e) {
                      var t,
                          n,
                          i = v.get(this, o);
                      if (1 & e.isTrigger && this[o]) {
                          if (i.length)
                              (E.event.special[o] || {}).delegateType &&
                                  e.stopPropagation();
                          else if (
                              ((i = c.call(arguments)),
                              v.set(this, o, i),
                              (t = r(this, o)),
                              this[o](),
                              i !== (n = v.get(this, o)) || t
                                  ? v.set(this, o, !1)
                                  : (n = {}),
                              i !== n)
                          )
                              return (
                                  e.stopImmediatePropagation(),
                                  e.preventDefault(),
                                  n && n.value
                              );
                      } else
                          i.length &&
                              (v.set(this, o, {
                                  value: E.event.trigger(
                                      E.extend(i[0], E.Event.prototype),
                                      i.slice(1),
                                      this
                                  ),
                              }),
                              e.stopImmediatePropagation());
                  },
              }))
            : void 0 === v.get(e, o) && E.event.add(e, o, ve);
    }
    (E.event = {
        global: {},
        add: function (t, u, e, h, n) {
            var d,
                i,
                o,
                f,
                r,
                s,
                a,
                l,
                c,
                p = v.get(t);
            if (Q(t))
                for (
                    e.handler && ((e = (d = e).handler), (n = d.selector)),
                        n && E.find.matchesSelector(ie, n),
                        e.guid || (e.guid = E.guid++),
                        (o = p.events) || (o = p.events = Object.create(null)),
                        (i = p.handle) ||
                            (i = p.handle =
                                function (e) {
                                    return void 0 !== E &&
                                        E.event.triggered !== e.type
                                        ? E.event.dispatch.apply(t, arguments)
                                        : void 0;
                                }),
                        f = (u = (u || "").match(M) || [""]).length;
                    f--;

                )
                    (a = c = (l = me.exec(u[f]) || [])[1]),
                        (l = (l[2] || "").split(".").sort()),
                        a &&
                            ((r = E.event.special[a] || {}),
                            (a = (n ? r.delegateType : r.bindType) || a),
                            (r = E.event.special[a] || {}),
                            (c = E.extend(
                                {
                                    type: a,
                                    origType: c,
                                    data: h,
                                    handler: e,
                                    guid: e.guid,
                                    selector: n,
                                    needsContext:
                                        n && E.expr.match.needsContext.test(n),
                                    namespace: l.join("."),
                                },
                                d
                            )),
                            (s = o[a]) ||
                                (((s = o[a] = []).delegateCount = 0),
                                (r.setup && !1 !== r.setup.call(t, h, l, i)) ||
                                    (t.addEventListener &&
                                        t.addEventListener(a, i))),
                            r.add &&
                                (r.add.call(t, c),
                                c.handler.guid || (c.handler.guid = e.guid)),
                            n ? s.splice(s.delegateCount++, 0, c) : s.push(c),
                            (E.event.global[a] = !0));
        },
        remove: function (e, t, u, n, h) {
            var i,
                d,
                o,
                r,
                f,
                s,
                a,
                l,
                c,
                p,
                g,
                m = v.hasData(e) && v.get(e);
            if (m && (r = m.events)) {
                for (f = (t = (t || "").match(M) || [""]).length; f--; )
                    if (
                        ((c = g = (o = me.exec(t[f]) || [])[1]),
                        (p = (o[2] || "").split(".").sort()),
                        c)
                    ) {
                        for (
                            a = E.event.special[c] || {},
                                l =
                                    r[
                                        (c =
                                            (n ? a.delegateType : a.bindType) ||
                                            c)
                                    ] || [],
                                o =
                                    o[2] &&
                                    new RegExp(
                                        "(^|\\.)" +
                                            p.join("\\.(?:.*\\.|)") +
                                            "(\\.|$)"
                                    ),
                                d = i = l.length;
                            i--;

                        )
                            (s = l[i]),
                                (!h && g !== s.origType) ||
                                    (u && u.guid !== s.guid) ||
                                    (o && !o.test(s.namespace)) ||
                                    (n &&
                                        n !== s.selector &&
                                        ("**" !== n || !s.selector)) ||
                                    (l.splice(i, 1),
                                    s.selector && l.delegateCount--,
                                    a.remove && a.remove.call(e, s));
                        d &&
                            !l.length &&
                            ((a.teardown &&
                                !1 !== a.teardown.call(e, p, m.handle)) ||
                                E.removeEvent(e, c, m.handle),
                            delete r[c]);
                    } else for (c in r) E.event.remove(e, c + t[f], u, n, !0);
                E.isEmptyObject(r) && v.remove(e, "handle events");
            }
        },
        dispatch: function (e) {
            var t,
                n,
                i,
                o,
                r,
                s = new Array(arguments.length),
                a = E.event.fix(e),
                e =
                    (v.get(this, "events") || Object.create(null))[a.type] ||
                    [],
                l = E.event.special[a.type] || {};
            for (s[0] = a, t = 1; t < arguments.length; t++)
                s[t] = arguments[t];
            if (
                ((a.delegateTarget = this),
                !l.preDispatch || !1 !== l.preDispatch.call(this, a))
            ) {
                for (
                    r = E.event.handlers.call(this, a, e), t = 0;
                    (i = r[t++]) && !a.isPropagationStopped();

                )
                    for (
                        a.currentTarget = i.elem, n = 0;
                        (o = i.handlers[n++]) &&
                        !a.isImmediatePropagationStopped();

                    )
                        (a.rnamespace &&
                            !1 !== o.namespace &&
                            !a.rnamespace.test(o.namespace)) ||
                            ((a.handleObj = o),
                            (a.data = o.data),
                            void 0 !==
                                (o = (
                                    (E.event.special[o.origType] || {})
                                        .handle || o.handler
                                ).apply(i.elem, s)) &&
                                !1 === (a.result = o) &&
                                (a.preventDefault(), a.stopPropagation()));
                return l.postDispatch && l.postDispatch.call(this, a), a.result;
            }
        },
        handlers: function (e, t) {
            var n,
                i,
                o,
                r,
                s,
                a = [],
                l = t.delegateCount,
                c = e.target;
            if (l && c.nodeType && !("click" === e.type && 1 <= e.button))
                for (; c !== this; c = c.parentNode || this)
                    if (
                        1 === c.nodeType &&
                        ("click" !== e.type || !0 !== c.disabled)
                    ) {
                        for (r = [], s = {}, n = 0; n < l; n++)
                            void 0 === s[(o = (i = t[n]).selector + " ")] &&
                                (s[o] = i.needsContext
                                    ? -1 < E(o, this).index(c)
                                    : E.find(o, this, null, [c]).length),
                                s[o] && r.push(i);
                        r.length && a.push({ elem: c, handlers: r });
                    }
            return (
                (c = this),
                l < t.length && a.push({ elem: c, handlers: t.slice(l) }),
                a
            );
        },
        addProp: function (t, e) {
            Object.defineProperty(E.Event.prototype, t, {
                enumerable: !0,
                configurable: !0,
                get: y(e)
                    ? function () {
                          if (this.originalEvent) return e(this.originalEvent);
                      }
                    : function () {
                          if (this.originalEvent) return this.originalEvent[t];
                      },
                set: function (e) {
                    Object.defineProperty(this, t, {
                        enumerable: !0,
                        configurable: !0,
                        writable: !0,
                        value: e,
                    });
                },
            });
        },
        fix: function (e) {
            return e[E.expando] ? e : new E.Event(e);
        },
        special: {
            load: { noBubble: !0 },
            click: {
                setup: function (e) {
                    e = this || e;
                    return (
                        ce.test(e.type) &&
                            e.click &&
                            l(e, "input") &&
                            we(e, "click", ve),
                        !1
                    );
                },
                trigger: function (e) {
                    e = this || e;
                    return (
                        ce.test(e.type) &&
                            e.click &&
                            l(e, "input") &&
                            we(e, "click"),
                        !0
                    );
                },
                _default: function (e) {
                    e = e.target;
                    return (
                        (ce.test(e.type) &&
                            e.click &&
                            l(e, "input") &&
                            v.get(e, "click")) ||
                        l(e, "a")
                    );
                },
            },
            beforeunload: {
                postDispatch: function (e) {
                    void 0 !== e.result &&
                        e.originalEvent &&
                        (e.originalEvent.returnValue = e.result);
                },
            },
        },
    }),
        (E.removeEvent = function (e, t, n) {
            e.removeEventListener && e.removeEventListener(t, n);
        }),
        (E.Event = function (e, t) {
            if (!(this instanceof E.Event)) return new E.Event(e, t);
            e && e.type
                ? ((this.originalEvent = e),
                  (this.type = e.type),
                  (this.isDefaultPrevented =
                      e.defaultPrevented ||
                      (void 0 === e.defaultPrevented && !1 === e.returnValue)
                          ? ve
                          : ye),
                  (this.target =
                      e.target && 3 === e.target.nodeType
                          ? e.target.parentNode
                          : e.target),
                  (this.currentTarget = e.currentTarget),
                  (this.relatedTarget = e.relatedTarget))
                : (this.type = e),
                t && E.extend(this, t),
                (this.timeStamp = (e && e.timeStamp) || Date.now()),
                (this[E.expando] = !0);
        }),
        (E.Event.prototype = {
            constructor: E.Event,
            isDefaultPrevented: ye,
            isPropagationStopped: ye,
            isImmediatePropagationStopped: ye,
            isSimulated: !1,
            preventDefault: function () {
                var e = this.originalEvent;
                (this.isDefaultPrevented = ve),
                    e && !this.isSimulated && e.preventDefault();
            },
            stopPropagation: function () {
                var e = this.originalEvent;
                (this.isPropagationStopped = ve),
                    e && !this.isSimulated && e.stopPropagation();
            },
            stopImmediatePropagation: function () {
                var e = this.originalEvent;
                (this.isImmediatePropagationStopped = ve),
                    e && !this.isSimulated && e.stopImmediatePropagation(),
                    this.stopPropagation();
            },
        }),
        E.each(
            {
                altKey: !0,
                bubbles: !0,
                cancelable: !0,
                changedTouches: !0,
                ctrlKey: !0,
                detail: !0,
                eventPhase: !0,
                metaKey: !0,
                pageX: !0,
                pageY: !0,
                shiftKey: !0,
                view: !0,
                char: !0,
                code: !0,
                charCode: !0,
                key: !0,
                keyCode: !0,
                button: !0,
                buttons: !0,
                clientX: !0,
                clientY: !0,
                offsetX: !0,
                offsetY: !0,
                pointerId: !0,
                pointerType: !0,
                screenX: !0,
                screenY: !0,
                targetTouches: !0,
                toElement: !0,
                touches: !0,
                which: !0,
            },
            E.event.addProp
        ),
        E.each({ focus: "focusin", blur: "focusout" }, function (e, t) {
            E.event.special[e] = {
                setup: function () {
                    return we(this, e, be), !1;
                },
                trigger: function () {
                    return we(this, e), !0;
                },
                _default: function () {
                    return !0;
                },
                delegateType: t,
            };
        }),
        E.each(
            {
                mouseenter: "mouseover",
                mouseleave: "mouseout",
                pointerenter: "pointerover",
                pointerleave: "pointerout",
            },
            function (e, o) {
                E.event.special[e] = {
                    delegateType: o,
                    bindType: o,
                    handle: function (e) {
                        var t,
                            n = e.relatedTarget,
                            i = e.handleObj;
                        return (
                            (n && (n === this || E.contains(this, n))) ||
                                ((e.type = i.origType),
                                (t = i.handler.apply(this, arguments)),
                                (e.type = o)),
                            t
                        );
                    },
                };
            }
        ),
        E.fn.extend({
            on: function (e, t, n, i) {
                return _e(this, e, t, n, i);
            },
            one: function (e, t, n, i) {
                return _e(this, e, t, n, i, 1);
            },
            off: function (e, t, n) {
                var i, o;
                if (e && e.preventDefault && e.handleObj)
                    return (
                        (i = e.handleObj),
                        E(e.delegateTarget).off(
                            i.namespace
                                ? i.origType + "." + i.namespace
                                : i.origType,
                            i.selector,
                            i.handler
                        ),
                        this
                    );
                if ("object" != typeof e)
                    return (
                        (!1 !== t && "function" != typeof t) ||
                            ((n = t), (t = void 0)),
                        !1 === n && (n = ye),
                        this.each(function () {
                            E.event.remove(this, e, n, t);
                        })
                    );
                for (o in e) this.off(o, t, e[o]);
                return this;
            },
        });
    var xe = /<script|<style|<link/i,
        Ee = /checked\s*(?:[^=]|=\s*.checked.)/i,
        Te = /^\s*<!(?:\[CDATA\[|--)|(?:\]\]|--)>\s*$/g;
    function ke(e, t) {
        return (
            (l(e, "table") &&
                l(11 !== t.nodeType ? t : t.firstChild, "tr") &&
                E(e).children("tbody")[0]) ||
            e
        );
    }
    function Ce(e) {
        return (e.type = (null !== e.getAttribute("type")) + "/" + e.type), e;
    }
    function Ae(e) {
        return (
            "true/" === (e.type || "").slice(0, 5)
                ? (e.type = e.type.slice(5))
                : e.removeAttribute("type"),
            e
        );
    }
    function Se(e, t) {
        var n, i, o, r;
        if (1 === t.nodeType) {
            if (v.hasData(e) && (r = v.get(e).events))
                for (o in (v.remove(t, "handle events"), r))
                    for (n = 0, i = r[o].length; n < i; n++)
                        E.event.add(t, o, r[o][n]);
            a.hasData(e) &&
                ((e = a.access(e)), (e = E.extend({}, e)), a.set(t, e));
        }
    }
    function Le(n, i, u, h) {
        i = _(i);
        var e,
            d,
            t,
            o,
            r,
            s,
            a = 0,
            l = n.length,
            f = l - 1,
            c = i[0],
            p = y(c);
        if (p || (1 < l && "string" == typeof c && !g.checkClone && Ee.test(c)))
            return n.each(function (e) {
                var t = n.eq(e);
                p && (i[0] = c.call(this, e, t.html())), Le(t, i, u, h);
            });
        if (
            l &&
            ((d = (e = ge(i, n[0].ownerDocument, !1, n, h)).firstChild),
            1 === e.childNodes.length && (e = d),
            d || h)
        ) {
            for (o = (t = E.map(m(e, "script"), Ce)).length; a < l; a++)
                (r = e),
                    a !== f &&
                        ((r = E.clone(r, !0, !0)),
                        o && E.merge(t, m(r, "script"))),
                    u.call(n[a], r, a);
            if (o)
                for (
                    s = t[t.length - 1].ownerDocument, E.map(t, Ae), a = 0;
                    a < o;
                    a++
                )
                    (r = t[a]),
                        he.test(r.type || "") &&
                            !v.access(r, "globalEval") &&
                            E.contains(s, r) &&
                            (r.src && "module" !== (r.type || "").toLowerCase()
                                ? E._evalUrl &&
                                  !r.noModule &&
                                  E._evalUrl(
                                      r.src,
                                      {
                                          nonce:
                                              r.nonce ||
                                              r.getAttribute("nonce"),
                                      },
                                      s
                                  )
                                : k(r.textContent.replace(Te, ""), r, s));
        }
        return n;
    }
    function De(e, t, n) {
        for (var i, o = t ? E.filter(t, e) : e, r = 0; null != (i = o[r]); r++)
            n || 1 !== i.nodeType || E.cleanData(m(i)),
                i.parentNode &&
                    (n && oe(i) && fe(m(i, "script")),
                    i.parentNode.removeChild(i));
        return e;
    }
    E.extend({
        htmlPrefilter: function (e) {
            return e;
        },
        clone: function (e, t, u) {
            var n,
                i,
                o,
                r,
                s,
                a,
                l,
                c = e.cloneNode(!0),
                h = oe(e);
            if (
                !(
                    g.noCloneChecked ||
                    (1 !== e.nodeType && 11 !== e.nodeType) ||
                    E.isXMLDoc(e)
                )
            )
                for (r = m(c), n = 0, i = (o = m(e)).length; n < i; n++)
                    (s = o[n]),
                        (a = r[n]),
                        (l = void 0),
                        "input" === (l = a.nodeName.toLowerCase()) &&
                        ce.test(s.type)
                            ? (a.checked = s.checked)
                            : ("input" !== l && "textarea" !== l) ||
                              (a.defaultValue = s.defaultValue);
            if (t)
                if (u)
                    for (
                        o = o || m(e), r = r || m(c), n = 0, i = o.length;
                        n < i;
                        n++
                    )
                        Se(o[n], r[n]);
                else Se(e, c);
            return (
                0 < (r = m(c, "script")).length && fe(r, !h && m(e, "script")),
                c
            );
        },
        cleanData: function (e) {
            for (
                var t, n, i, o = E.event.special, r = 0;
                void 0 !== (n = e[r]);
                r++
            )
                if (Q(n)) {
                    if ((t = n[v.expando])) {
                        if (t.events)
                            for (i in t.events)
                                o[i]
                                    ? E.event.remove(n, i)
                                    : E.removeEvent(n, i, t.handle);
                        n[v.expando] = void 0;
                    }
                    n[a.expando] && (n[a.expando] = void 0);
                }
        },
    }),
        E.fn.extend({
            detach: function (e) {
                return De(this, e, !0);
            },
            remove: function (e) {
                return De(this, e);
            },
            text: function (e) {
                return $(
                    this,
                    function (e) {
                        return void 0 === e
                            ? E.text(this)
                            : this.empty().each(function () {
                                  (1 !== this.nodeType &&
                                      11 !== this.nodeType &&
                                      9 !== this.nodeType) ||
                                      (this.textContent = e);
                              });
                    },
                    null,
                    e,
                    arguments.length
                );
            },
            append: function () {
                return Le(this, arguments, function (e) {
                    (1 !== this.nodeType &&
                        11 !== this.nodeType &&
                        9 !== this.nodeType) ||
                        ke(this, e).appendChild(e);
                });
            },
            prepend: function () {
                return Le(this, arguments, function (e) {
                    var t;
                    (1 !== this.nodeType &&
                        11 !== this.nodeType &&
                        9 !== this.nodeType) ||
                        (t = ke(this, e)).insertBefore(e, t.firstChild);
                });
            },
            before: function () {
                return Le(this, arguments, function (e) {
                    this.parentNode && this.parentNode.insertBefore(e, this);
                });
            },
            after: function () {
                return Le(this, arguments, function (e) {
                    this.parentNode &&
                        this.parentNode.insertBefore(e, this.nextSibling);
                });
            },
            empty: function () {
                for (var e, t = 0; null != (e = this[t]); t++)
                    1 === e.nodeType &&
                        (E.cleanData(m(e, !1)), (e.textContent = ""));
                return this;
            },
            clone: function (e, t) {
                return (
                    (e = null != e && e),
                    (t = null == t ? e : t),
                    this.map(function () {
                        return E.clone(this, e, t);
                    })
                );
            },
            html: function (e) {
                return $(
                    this,
                    function (e) {
                        var t = this[0] || {},
                            n = 0,
                            i = this.length;
                        if (void 0 === e && 1 === t.nodeType)
                            return t.innerHTML;
                        if (
                            "string" == typeof e &&
                            !xe.test(e) &&
                            !de[(ue.exec(e) || ["", ""])[1].toLowerCase()]
                        ) {
                            e = E.htmlPrefilter(e);
                            try {
                                for (; n < i; n++)
                                    1 === (t = this[n] || {}).nodeType &&
                                        (E.cleanData(m(t, !1)),
                                        (t.innerHTML = e));
                                t = 0;
                            } catch (e) {}
                        }
                        t && this.empty().append(e);
                    },
                    null,
                    e,
                    arguments.length
                );
            },
            replaceWith: function () {
                var n = [];
                return Le(
                    this,
                    arguments,
                    function (e) {
                        var t = this.parentNode;
                        E.inArray(this, n) < 0 &&
                            (E.cleanData(m(this)),
                            t && t.replaceChild(e, this));
                    },
                    n
                );
            },
        }),
        E.each(
            {
                appendTo: "append",
                prependTo: "prepend",
                insertBefore: "before",
                insertAfter: "after",
                replaceAll: "replaceWith",
            },
            function (e, s) {
                E.fn[e] = function (e) {
                    for (
                        var t, n = [], i = E(e), o = i.length - 1, r = 0;
                        r <= o;
                        r++
                    )
                        (t = r === o ? this : this.clone(!0)),
                            E(i[r])[s](t),
                            u.apply(n, t.get());
                    return this.pushStack(n);
                };
            }
        );
    function Ne(e) {
        var t = e.ownerDocument.defaultView;
        return (t = t && t.opener ? t : w).getComputedStyle(e);
    }
    function Oe(e, t, n) {
        var i,
            o = {};
        for (i in t) (o[i] = e.style[i]), (e.style[i] = t[i]);
        for (i in ((n = n.call(e)), t)) e.style[i] = o[i];
        return n;
    }
    var je,
        Ie,
        Pe,
        He,
        Me,
        qe,
        Re,
        Be,
        We = new RegExp("^(" + e + ")(?!px)[a-z%]+$", "i"),
        Fe = new RegExp(ne.join("|"), "i");
    function ze() {
        var e;
        Be &&
            ((Re.style.cssText =
                "position:absolute;left:-11111px;width:60px;margin-top:1px;padding:0;border:0"),
            (Be.style.cssText =
                "position:relative;display:block;box-sizing:border-box;overflow:scroll;margin:auto;border:1px;padding:1px;width:60%;top:1%"),
            ie.appendChild(Re).appendChild(Be),
            (e = w.getComputedStyle(Be)),
            (je = "1%" !== e.top),
            (qe = 12 === $e(e.marginLeft)),
            (Be.style.right = "60%"),
            (He = 36 === $e(e.right)),
            (Ie = 36 === $e(e.width)),
            (Be.style.position = "absolute"),
            (Pe = 12 === $e(Be.offsetWidth / 3)),
            ie.removeChild(Re),
            (Be = null));
    }
    function $e(e) {
        return Math.round(parseFloat(e));
    }
    function Ue(e, t, n) {
        var i,
            o,
            r = e.style;
        return (
            (n = n || Ne(e)) &&
                ("" !== (o = n.getPropertyValue(t) || n[t]) ||
                    oe(e) ||
                    (o = E.style(e, t)),
                !g.pixelBoxStyles() &&
                    We.test(o) &&
                    Fe.test(t) &&
                    ((e = r.width),
                    (t = r.minWidth),
                    (i = r.maxWidth),
                    (r.minWidth = r.maxWidth = r.width = o),
                    (o = n.width),
                    (r.width = e),
                    (r.minWidth = t),
                    (r.maxWidth = i))),
            void 0 !== o ? o + "" : o
        );
    }
    function Xe(e, t) {
        return {
            get: function () {
                if (!e()) return (this.get = t).apply(this, arguments);
                delete this.get;
            },
        };
    }
    (Re = x.createElement("div")),
        (Be = x.createElement("div")).style &&
            ((Be.style.backgroundClip = "content-box"),
            (Be.cloneNode(!0).style.backgroundClip = ""),
            (g.clearCloneStyle = "content-box" === Be.style.backgroundClip),
            E.extend(g, {
                boxSizingReliable: function () {
                    return ze(), Ie;
                },
                pixelBoxStyles: function () {
                    return ze(), He;
                },
                pixelPosition: function () {
                    return ze(), je;
                },
                reliableMarginLeft: function () {
                    return ze(), qe;
                },
                scrollboxSize: function () {
                    return ze(), Pe;
                },
                reliableTrDimensions: function () {
                    var e, t, n;
                    return (
                        null == Me &&
                            ((e = x.createElement("table")),
                            (t = x.createElement("tr")),
                            (n = x.createElement("div")),
                            (e.style.cssText =
                                "position:absolute;left:-11111px;border-collapse:separate"),
                            (t.style.cssText = "border:1px solid"),
                            (t.style.height = "1px"),
                            (n.style.height = "9px"),
                            (n.style.display = "block"),
                            ie.appendChild(e).appendChild(t).appendChild(n),
                            (n = w.getComputedStyle(t)),
                            (Me =
                                parseInt(n.height, 10) +
                                    parseInt(n.borderTopWidth, 10) +
                                    parseInt(n.borderBottomWidth, 10) ===
                                t.offsetHeight),
                            ie.removeChild(e)),
                        Me
                    );
                },
            }));
    var Ve = ["Webkit", "Moz", "ms"],
        Ye = x.createElement("div").style,
        Qe = {};
    function Ge(e) {
        var t = E.cssProps[e] || Qe[e];
        return (
            t ||
            (e in Ye
                ? e
                : (Qe[e] =
                      (function (e) {
                          for (
                              var t = e[0].toUpperCase() + e.slice(1),
                                  n = Ve.length;
                              n--;

                          )
                              if ((e = Ve[n] + t) in Ye) return e;
                      })(e) || e))
        );
    }
    var Ke = /^(none|table(?!-c[ea]).+)/,
        Je = /^--/,
        Ze = { position: "absolute", visibility: "hidden", display: "block" },
        et = { letterSpacing: "0", fontWeight: "400" };
    function tt(e, t, n) {
        var i = te.exec(t);
        return i ? Math.max(0, i[2] - (n || 0)) + (i[3] || "px") : t;
    }
    function nt(e, t, n, i, o, r) {
        var s = "width" === t ? 1 : 0,
            a = 0,
            l = 0;
        if (n === (i ? "border" : "content")) return 0;
        for (; s < 4; s += 2)
            "margin" === n && (l += E.css(e, n + ne[s], !0, o)),
                i
                    ? ("content" === n &&
                          (l -= E.css(e, "padding" + ne[s], !0, o)),
                      "margin" !== n &&
                          (l -= E.css(e, "border" + ne[s] + "Width", !0, o)))
                    : ((l += E.css(e, "padding" + ne[s], !0, o)),
                      "padding" !== n
                          ? (l += E.css(e, "border" + ne[s] + "Width", !0, o))
                          : (a += E.css(e, "border" + ne[s] + "Width", !0, o)));
        return (
            !i &&
                0 <= r &&
                (l +=
                    Math.max(
                        0,
                        Math.ceil(
                            e["offset" + t[0].toUpperCase() + t.slice(1)] -
                                r -
                                l -
                                a -
                                0.5
                        )
                    ) || 0),
            l
        );
    }
    function it(e, t, n) {
        var i = Ne(e),
            o =
                (!g.boxSizingReliable() || n) &&
                "border-box" === E.css(e, "boxSizing", !1, i),
            r = o,
            s = Ue(e, t, i),
            a = "offset" + t[0].toUpperCase() + t.slice(1);
        if (We.test(s)) {
            if (!n) return s;
            s = "auto";
        }
        return (
            ((!g.boxSizingReliable() && o) ||
                (!g.reliableTrDimensions() && l(e, "tr")) ||
                "auto" === s ||
                (!parseFloat(s) && "inline" === E.css(e, "display", !1, i))) &&
                e.getClientRects().length &&
                ((o = "border-box" === E.css(e, "boxSizing", !1, i)),
                (r = a in e) && (s = e[a])),
            (s = parseFloat(s) || 0) +
                nt(e, t, n || (o ? "border" : "content"), r, i, s) +
                "px"
        );
    }
    function ot(e, t, n, i, o) {
        return new ot.prototype.init(e, t, n, i, o);
    }
    E.extend({
        cssHooks: {
            opacity: {
                get: function (e, t) {
                    if (t) return "" === (t = Ue(e, "opacity")) ? "1" : t;
                },
            },
        },
        cssNumber: {
            animationIterationCount: !0,
            columnCount: !0,
            fillOpacity: !0,
            flexGrow: !0,
            flexShrink: !0,
            fontWeight: !0,
            gridArea: !0,
            gridColumn: !0,
            gridColumnEnd: !0,
            gridColumnStart: !0,
            gridRow: !0,
            gridRowEnd: !0,
            gridRowStart: !0,
            lineHeight: !0,
            opacity: !0,
            order: !0,
            orphans: !0,
            widows: !0,
            zIndex: !0,
            zoom: !0,
        },
        cssProps: {},
        style: function (e, t, n, i) {
            if (e && 3 !== e.nodeType && 8 !== e.nodeType && e.style) {
                var o,
                    r,
                    s,
                    a = Y(t),
                    l = Je.test(t),
                    c = e.style;
                if (
                    (l || (t = Ge(a)),
                    (s = E.cssHooks[t] || E.cssHooks[a]),
                    void 0 === n)
                )
                    return s && "get" in s && void 0 !== (o = s.get(e, !1, i))
                        ? o
                        : c[t];
                "string" === (r = typeof n) &&
                    (o = te.exec(n)) &&
                    o[1] &&
                    ((n = se(e, t, o)), (r = "number")),
                    null != n &&
                        n == n &&
                        ("number" !== r ||
                            l ||
                            (n += (o && o[3]) || (E.cssNumber[a] ? "" : "px")),
                        g.clearCloneStyle ||
                            "" !== n ||
                            0 !== t.indexOf("background") ||
                            (c[t] = "inherit"),
                        (s && "set" in s && void 0 === (n = s.set(e, n, i))) ||
                            (l ? c.setProperty(t, n) : (c[t] = n)));
            }
        },
        css: function (e, t, n, i) {
            var o,
                r = Y(t);
            return (
                Je.test(t) || (t = Ge(r)),
                "normal" ===
                    (o =
                        void 0 ===
                        (o =
                            (r = E.cssHooks[t] || E.cssHooks[r]) && "get" in r
                                ? r.get(e, !0, n)
                                : o)
                            ? Ue(e, t, i)
                            : o) &&
                    t in et &&
                    (o = et[t]),
                "" === n || n
                    ? ((r = parseFloat(o)),
                      !0 === n || isFinite(r) ? r || 0 : o)
                    : o
            );
        },
    }),
        E.each(["height", "width"], function (e, a) {
            E.cssHooks[a] = {
                get: function (e, t, n) {
                    if (t)
                        return !Ke.test(E.css(e, "display")) ||
                            (e.getClientRects().length &&
                                e.getBoundingClientRect().width)
                            ? it(e, a, n)
                            : Oe(e, Ze, function () {
                                  return it(e, a, n);
                              });
                },
                set: function (e, t, n) {
                    var i,
                        o = Ne(e),
                        r = !g.scrollboxSize() && "absolute" === o.position,
                        s =
                            (r || n) &&
                            "border-box" === E.css(e, "boxSizing", !1, o),
                        n = n ? nt(e, a, n, s, o) : 0;
                    return (
                        s &&
                            r &&
                            (n -= Math.ceil(
                                e["offset" + a[0].toUpperCase() + a.slice(1)] -
                                    parseFloat(o[a]) -
                                    nt(e, a, "border", !1, o) -
                                    0.5
                            )),
                        n &&
                            (i = te.exec(t)) &&
                            "px" !== (i[3] || "px") &&
                            ((e.style[a] = t), (t = E.css(e, a))),
                        tt(0, t, n)
                    );
                },
            };
        }),
        (E.cssHooks.marginLeft = Xe(g.reliableMarginLeft, function (e, t) {
            if (t)
                return (
                    (parseFloat(Ue(e, "marginLeft")) ||
                        e.getBoundingClientRect().left -
                            Oe(e, { marginLeft: 0 }, function () {
                                return e.getBoundingClientRect().left;
                            })) + "px"
                );
        })),
        E.each({ margin: "", padding: "", border: "Width" }, function (o, r) {
            (E.cssHooks[o + r] = {
                expand: function (e) {
                    for (
                        var t = 0,
                            n = {},
                            i = "string" == typeof e ? e.split(" ") : [e];
                        t < 4;
                        t++
                    )
                        n[o + ne[t] + r] = i[t] || i[t - 2] || i[0];
                    return n;
                },
            }),
                "margin" !== o && (E.cssHooks[o + r].set = tt);
        }),
        E.fn.extend({
            css: function (e, t) {
                return $(
                    this,
                    function (e, t, n) {
                        var i,
                            o,
                            r = {},
                            s = 0;
                        if (Array.isArray(t)) {
                            for (i = Ne(e), o = t.length; s < o; s++)
                                r[t[s]] = E.css(e, t[s], !1, i);
                            return r;
                        }
                        return void 0 !== n ? E.style(e, t, n) : E.css(e, t);
                    },
                    e,
                    t,
                    1 < arguments.length
                );
            },
        }),
        (((E.Tween = ot).prototype = {
            constructor: ot,
            init: function (e, t, n, i, o, r) {
                (this.elem = e),
                    (this.prop = n),
                    (this.easing = o || E.easing._default),
                    (this.options = t),
                    (this.start = this.now = this.cur()),
                    (this.end = i),
                    (this.unit = r || (E.cssNumber[n] ? "" : "px"));
            },
            cur: function () {
                var e = ot.propHooks[this.prop];
                return (e && e.get ? e : ot.propHooks._default).get(this);
            },
            run: function (e) {
                var t,
                    n = ot.propHooks[this.prop];
                return (
                    this.options.duration
                        ? (this.pos = t =
                              E.easing[this.easing](
                                  e,
                                  this.options.duration * e,
                                  0,
                                  1,
                                  this.options.duration
                              ))
                        : (this.pos = t = e),
                    (this.now = (this.end - this.start) * t + this.start),
                    this.options.step &&
                        this.options.step.call(this.elem, this.now, this),
                    (n && n.set ? n : ot.propHooks._default).set(this),
                    this
                );
            },
        }).init.prototype = ot.prototype),
        ((ot.propHooks = {
            _default: {
                get: function (e) {
                    return 1 !== e.elem.nodeType ||
                        (null != e.elem[e.prop] && null == e.elem.style[e.prop])
                        ? e.elem[e.prop]
                        : (e = E.css(e.elem, e.prop, "")) && "auto" !== e
                        ? e
                        : 0;
                },
                set: function (e) {
                    E.fx.step[e.prop]
                        ? E.fx.step[e.prop](e)
                        : 1 !== e.elem.nodeType ||
                          (!E.cssHooks[e.prop] &&
                              null == e.elem.style[Ge(e.prop)])
                        ? (e.elem[e.prop] = e.now)
                        : E.style(e.elem, e.prop, e.now + e.unit);
                },
            },
        }).scrollTop = ot.propHooks.scrollLeft =
            {
                set: function (e) {
                    e.elem.nodeType &&
                        e.elem.parentNode &&
                        (e.elem[e.prop] = e.now);
                },
            }),
        (E.easing = {
            linear: function (e) {
                return e;
            },
            swing: function (e) {
                return 0.5 - Math.cos(e * Math.PI) / 2;
            },
            _default: "swing",
        }),
        (E.fx = ot.prototype.init),
        (E.fx.step = {});
    var rt,
        st,
        at,
        lt,
        ct = /^(?:toggle|show|hide)$/,
        ut = /queueHooks$/;
    function ht() {
        st &&
            (!1 === x.hidden && w.requestAnimationFrame
                ? w.requestAnimationFrame(ht)
                : w.setTimeout(ht, E.fx.interval),
            E.fx.tick());
    }
    function dt() {
        return (
            w.setTimeout(function () {
                rt = void 0;
            }),
            (rt = Date.now())
        );
    }
    function ft(e, t) {
        var n,
            i = 0,
            o = { height: e };
        for (t = t ? 1 : 0; i < 4; i += 2 - t)
            o["margin" + (n = ne[i])] = o["padding" + n] = e;
        return t && (o.opacity = o.width = e), o;
    }
    function pt(e, t, n) {
        for (
            var i,
                o = (gt.tweeners[t] || []).concat(gt.tweeners["*"]),
                r = 0,
                s = o.length;
            r < s;
            r++
        )
            if ((i = o[r].call(n, t, e))) return i;
    }
    function gt(o, u, e) {
        var t,
            h,
            n,
            i,
            r,
            s,
            d,
            f = 0,
            p = gt.prefilters.length,
            a = E.Deferred().always(function () {
                delete g.elem;
            }),
            g = function () {
                if (h) return !1;
                for (
                    var e = rt || dt(),
                        e = Math.max(0, l.startTime + l.duration - e),
                        t = 1 - (e / l.duration || 0),
                        n = 0,
                        i = l.tweens.length;
                    n < i;
                    n++
                )
                    l.tweens[n].run(t);
                return (
                    a.notifyWith(o, [l, t, e]),
                    t < 1 && i
                        ? e
                        : (i || a.notifyWith(o, [l, 1, 0]),
                          a.resolveWith(o, [l]),
                          !1)
                );
            },
            l = a.promise({
                elem: o,
                props: E.extend({}, u),
                opts: E.extend(
                    !0,
                    { specialEasing: {}, easing: E.easing._default },
                    e
                ),
                originalProperties: u,
                originalOptions: e,
                startTime: rt || dt(),
                duration: e.duration,
                tweens: [],
                createTween: function (e, t) {
                    t = E.Tween(
                        o,
                        l.opts,
                        e,
                        t,
                        l.opts.specialEasing[e] || l.opts.easing
                    );
                    return l.tweens.push(t), t;
                },
                stop: function (e) {
                    var t = 0,
                        n = e ? l.tweens.length : 0;
                    if (h) return this;
                    for (h = !0; t < n; t++) l.tweens[t].run(1);
                    return (
                        e
                            ? (a.notifyWith(o, [l, 1, 0]),
                              a.resolveWith(o, [l, e]))
                            : a.rejectWith(o, [l, e]),
                        this
                    );
                },
            }),
            m = l.props,
            c = m,
            v = l.opts.specialEasing;
        for (n in c)
            if (
                ((r = v[(i = Y(n))]),
                (s = c[n]),
                Array.isArray(s) && ((r = s[1]), (s = c[n] = s[0])),
                n !== i && ((c[i] = s), delete c[n]),
                (d = E.cssHooks[i]) && "expand" in d)
            )
                for (n in ((s = d.expand(s)), delete c[i], s))
                    n in c || ((c[n] = s[n]), (v[n] = r));
            else v[i] = r;
        for (; f < p; f++)
            if ((t = gt.prefilters[f].call(l, o, m, l.opts)))
                return (
                    y(t.stop) &&
                        (E._queueHooks(l.elem, l.opts.queue).stop =
                            t.stop.bind(t)),
                    t
                );
        return (
            E.map(m, pt, l),
            y(l.opts.start) && l.opts.start.call(o, l),
            l
                .progress(l.opts.progress)
                .done(l.opts.done, l.opts.complete)
                .fail(l.opts.fail)
                .always(l.opts.always),
            E.fx.timer(E.extend(g, { elem: o, anim: l, queue: l.opts.queue })),
            l
        );
    }
    (E.Animation = E.extend(gt, {
        tweeners: {
            "*": [
                function (e, t) {
                    var n = this.createTween(e, t);
                    return se(n.elem, e, te.exec(t), n), n;
                },
            ],
        },
        tweener: function (e, t) {
            for (
                var n,
                    i = 0,
                    o = (e = y(e) ? ((t = e), ["*"]) : e.match(M)).length;
                i < o;
                i++
            )
                (n = e[i]),
                    (gt.tweeners[n] = gt.tweeners[n] || []),
                    gt.tweeners[n].unshift(t);
        },
        prefilters: [
            function (e, t, u) {
                var n,
                    h,
                    d,
                    i,
                    f,
                    o,
                    r,
                    s = "width" in t || "height" in t,
                    p = this,
                    g = {},
                    a = e.style,
                    l = e.nodeType && ee(e),
                    c = v.get(e, "fxshow");
                for (n in (u.queue ||
                    (null == (i = E._queueHooks(e, "fx")).unqueued &&
                        ((i.unqueued = 0),
                        (f = i.empty.fire),
                        (i.empty.fire = function () {
                            i.unqueued || f();
                        })),
                    i.unqueued++,
                    p.always(function () {
                        p.always(function () {
                            i.unqueued--,
                                E.queue(e, "fx").length || i.empty.fire();
                        });
                    })),
                t))
                    if (((h = t[n]), ct.test(h))) {
                        if (
                            (delete t[n],
                            (d = d || "toggle" === h),
                            h === (l ? "hide" : "show"))
                        ) {
                            if ("show" !== h || !c || void 0 === c[n]) continue;
                            l = !0;
                        }
                        g[n] = (c && c[n]) || E.style(e, n);
                    }
                if ((o = !E.isEmptyObject(t)) || !E.isEmptyObject(g))
                    for (n in (s &&
                        1 === e.nodeType &&
                        ((u.overflow = [a.overflow, a.overflowX, a.overflowY]),
                        null == (r = c && c.display) &&
                            (r = v.get(e, "display")),
                        "none" === (s = E.css(e, "display")) &&
                            (r
                                ? (s = r)
                                : (le([e], !0),
                                  (r = e.style.display || r),
                                  (s = E.css(e, "display")),
                                  le([e]))),
                        ("inline" === s ||
                            ("inline-block" === s && null != r)) &&
                            "none" === E.css(e, "float") &&
                            (o ||
                                (p.done(function () {
                                    a.display = r;
                                }),
                                null == r &&
                                    ((s = a.display),
                                    (r = "none" === s ? "" : s))),
                            (a.display = "inline-block"))),
                    u.overflow &&
                        ((a.overflow = "hidden"),
                        p.always(function () {
                            (a.overflow = u.overflow[0]),
                                (a.overflowX = u.overflow[1]),
                                (a.overflowY = u.overflow[2]);
                        })),
                    (o = !1),
                    g))
                        o ||
                            (c
                                ? "hidden" in c && (l = c.hidden)
                                : (c = v.access(e, "fxshow", { display: r })),
                            d && (c.hidden = !l),
                            l && le([e], !0),
                            p.done(function () {
                                for (n in (l || le([e]),
                                v.remove(e, "fxshow"),
                                g))
                                    E.style(e, n, g[n]);
                            })),
                            (o = pt(l ? c[n] : 0, n, p)),
                            n in c ||
                                ((c[n] = o.start),
                                l && ((o.end = o.start), (o.start = 0)));
            },
        ],
        prefilter: function (e, t) {
            t ? gt.prefilters.unshift(e) : gt.prefilters.push(e);
        },
    })),
        (E.speed = function (e, t, n) {
            var i =
                e && "object" == typeof e
                    ? E.extend({}, e)
                    : {
                          complete: n || (!n && t) || (y(e) && e),
                          duration: e,
                          easing: (n && t) || (t && !y(t) && t),
                      };
            return (
                E.fx.off
                    ? (i.duration = 0)
                    : "number" != typeof i.duration &&
                      (i.duration in E.fx.speeds
                          ? (i.duration = E.fx.speeds[i.duration])
                          : (i.duration = E.fx.speeds._default)),
                (null != i.queue && !0 !== i.queue) || (i.queue = "fx"),
                (i.old = i.complete),
                (i.complete = function () {
                    y(i.old) && i.old.call(this),
                        i.queue && E.dequeue(this, i.queue);
                }),
                i
            );
        }),
        E.fn.extend({
            fadeTo: function (e, t, n, i) {
                return this.filter(ee)
                    .css("opacity", 0)
                    .show()
                    .end()
                    .animate({ opacity: t }, e, n, i);
            },
            animate: function (t, e, n, i) {
                function o() {
                    var e = gt(this, E.extend({}, t), s);
                    (r || v.get(this, "finish")) && e.stop(!0);
                }
                var r = E.isEmptyObject(t),
                    s = E.speed(e, n, i);
                return (
                    (o.finish = o),
                    r || !1 === s.queue ? this.each(o) : this.queue(s.queue, o)
                );
            },
            stop: function (o, e, r) {
                function s(e) {
                    var t = e.stop;
                    delete e.stop, t(r);
                }
                return (
                    "string" != typeof o && ((r = e), (e = o), (o = void 0)),
                    e && this.queue(o || "fx", []),
                    this.each(function () {
                        var e = !0,
                            t = null != o && o + "queueHooks",
                            n = E.timers,
                            i = v.get(this);
                        if (t) i[t] && i[t].stop && s(i[t]);
                        else
                            for (t in i)
                                i[t] && i[t].stop && ut.test(t) && s(i[t]);
                        for (t = n.length; t--; )
                            n[t].elem !== this ||
                                (null != o && n[t].queue !== o) ||
                                (n[t].anim.stop(r), (e = !1), n.splice(t, 1));
                        (!e && r) || E.dequeue(this, o);
                    })
                );
            },
            finish: function (s) {
                return (
                    !1 !== s && (s = s || "fx"),
                    this.each(function () {
                        var e,
                            t = v.get(this),
                            n = t[s + "queue"],
                            i = t[s + "queueHooks"],
                            o = E.timers,
                            r = n ? n.length : 0;
                        for (
                            t.finish = !0,
                                E.queue(this, s, []),
                                i && i.stop && i.stop.call(this, !0),
                                e = o.length;
                            e--;

                        )
                            o[e].elem === this &&
                                o[e].queue === s &&
                                (o[e].anim.stop(!0), o.splice(e, 1));
                        for (e = 0; e < r; e++)
                            n[e] && n[e].finish && n[e].finish.call(this);
                        delete t.finish;
                    })
                );
            },
        }),
        E.each(["toggle", "show", "hide"], function (e, i) {
            var o = E.fn[i];
            E.fn[i] = function (e, t, n) {
                return null == e || "boolean" == typeof e
                    ? o.apply(this, arguments)
                    : this.animate(ft(i, !0), e, t, n);
            };
        }),
        E.each(
            {
                slideDown: ft("show"),
                slideUp: ft("hide"),
                slideToggle: ft("toggle"),
                fadeIn: { opacity: "show" },
                fadeOut: { opacity: "hide" },
                fadeToggle: { opacity: "toggle" },
            },
            function (e, i) {
                E.fn[e] = function (e, t, n) {
                    return this.animate(i, e, t, n);
                };
            }
        ),
        (E.timers = []),
        (E.fx.tick = function () {
            var e,
                t = 0,
                n = E.timers;
            for (rt = Date.now(); t < n.length; t++)
                (e = n[t])() || n[t] !== e || n.splice(t--, 1);
            n.length || E.fx.stop(), (rt = void 0);
        }),
        (E.fx.timer = function (e) {
            E.timers.push(e), E.fx.start();
        }),
        (E.fx.interval = 13),
        (E.fx.start = function () {
            st || ((st = !0), ht());
        }),
        (E.fx.stop = function () {
            st = null;
        }),
        (E.fx.speeds = { slow: 600, fast: 200, _default: 400 }),
        (E.fn.delay = function (i, e) {
            return (
                (i = (E.fx && E.fx.speeds[i]) || i),
                this.queue((e = e || "fx"), function (e, t) {
                    var n = w.setTimeout(e, i);
                    t.stop = function () {
                        w.clearTimeout(n);
                    };
                })
            );
        }),
        (at = x.createElement("input")),
        (lt = x.createElement("select").appendChild(x.createElement("option"))),
        (at.type = "checkbox"),
        (g.checkOn = "" !== at.value),
        (g.optSelected = lt.selected),
        ((at = x.createElement("input")).value = "t"),
        (at.type = "radio"),
        (g.radioValue = "t" === at.value);
    var mt,
        vt = E.expr.attrHandle,
        yt =
            (E.fn.extend({
                attr: function (e, t) {
                    return $(this, E.attr, e, t, 1 < arguments.length);
                },
                removeAttr: function (e) {
                    return this.each(function () {
                        E.removeAttr(this, e);
                    });
                },
            }),
            E.extend({
                attr: function (e, t, n) {
                    var i,
                        o,
                        r = e.nodeType;
                    if (3 !== r && 8 !== r && 2 !== r)
                        return void 0 === e.getAttribute
                            ? E.prop(e, t, n)
                            : ((1 === r && E.isXMLDoc(e)) ||
                                  (o =
                                      E.attrHooks[t.toLowerCase()] ||
                                      (E.expr.match.bool.test(t)
                                          ? mt
                                          : void 0)),
                              void 0 !== n
                                  ? null === n
                                      ? void E.removeAttr(e, t)
                                      : o &&
                                        "set" in o &&
                                        void 0 !== (i = o.set(e, n, t))
                                      ? i
                                      : (e.setAttribute(t, n + ""), n)
                                  : !(
                                        o &&
                                        "get" in o &&
                                        null !== (i = o.get(e, t))
                                    ) && null == (i = E.find.attr(e, t))
                                  ? void 0
                                  : i);
                },
                attrHooks: {
                    type: {
                        set: function (e, t) {
                            var n;
                            if (!g.radioValue && "radio" === t && l(e, "input"))
                                return (
                                    (n = e.value),
                                    e.setAttribute("type", t),
                                    n && (e.value = n),
                                    t
                                );
                        },
                    },
                },
                removeAttr: function (e, t) {
                    var n,
                        i = 0,
                        o = t && t.match(M);
                    if (o && 1 === e.nodeType)
                        for (; (n = o[i++]); ) e.removeAttribute(n);
                },
            }),
            (mt = {
                set: function (e, t, n) {
                    return (
                        !1 === t ? E.removeAttr(e, n) : e.setAttribute(n, n), n
                    );
                },
            }),
            E.each(E.expr.match.bool.source.match(/\w+/g), function (e, t) {
                var s = vt[t] || E.find.attr;
                vt[t] = function (e, t, n) {
                    var i,
                        o,
                        r = t.toLowerCase();
                    return (
                        n ||
                            ((o = vt[r]),
                            (vt[r] = i),
                            (i = null != s(e, t, n) ? r : null),
                            (vt[r] = o)),
                        i
                    );
                };
            }),
            /^(?:input|select|textarea|button)$/i),
        bt = /^(?:a|area)$/i;
    function _t(e) {
        return (e.match(M) || []).join(" ");
    }
    function wt(e) {
        return (e.getAttribute && e.getAttribute("class")) || "";
    }
    function xt(e) {
        return Array.isArray(e)
            ? e
            : ("string" == typeof e && e.match(M)) || [];
    }
    E.fn.extend({
        prop: function (e, t) {
            return $(this, E.prop, e, t, 1 < arguments.length);
        },
        removeProp: function (e) {
            return this.each(function () {
                delete this[E.propFix[e] || e];
            });
        },
    }),
        E.extend({
            prop: function (e, t, n) {
                var i,
                    o,
                    r = e.nodeType;
                if (3 !== r && 8 !== r && 2 !== r)
                    return (
                        (1 === r && E.isXMLDoc(e)) ||
                            ((t = E.propFix[t] || t), (o = E.propHooks[t])),
                        void 0 !== n
                            ? o && "set" in o && void 0 !== (i = o.set(e, n, t))
                                ? i
                                : (e[t] = n)
                            : o && "get" in o && null !== (i = o.get(e, t))
                            ? i
                            : e[t]
                    );
            },
            propHooks: {
                tabIndex: {
                    get: function (e) {
                        var t = E.find.attr(e, "tabindex");
                        return t
                            ? parseInt(t, 10)
                            : yt.test(e.nodeName) ||
                              (bt.test(e.nodeName) && e.href)
                            ? 0
                            : -1;
                    },
                },
            },
            propFix: { for: "htmlFor", class: "className" },
        }),
        g.optSelected ||
            (E.propHooks.selected = {
                get: function (e) {
                    e = e.parentNode;
                    return (
                        e && e.parentNode && e.parentNode.selectedIndex, null
                    );
                },
                set: function (e) {
                    e = e.parentNode;
                    e &&
                        (e.selectedIndex,
                        e.parentNode && e.parentNode.selectedIndex);
                },
            }),
        E.each(
            [
                "tabIndex",
                "readOnly",
                "maxLength",
                "cellSpacing",
                "cellPadding",
                "rowSpan",
                "colSpan",
                "useMap",
                "frameBorder",
                "contentEditable",
            ],
            function () {
                E.propFix[this.toLowerCase()] = this;
            }
        ),
        E.fn.extend({
            addClass: function (t) {
                var e,
                    n,
                    i,
                    o,
                    r,
                    s,
                    a = 0;
                if (y(t))
                    return this.each(function (e) {
                        E(this).addClass(t.call(this, e, wt(this)));
                    });
                if ((e = xt(t)).length)
                    for (; (n = this[a++]); )
                        if (
                            ((s = wt(n)),
                            (i = 1 === n.nodeType && " " + _t(s) + " "))
                        ) {
                            for (r = 0; (o = e[r++]); )
                                i.indexOf(" " + o + " ") < 0 && (i += o + " ");
                            s !== (s = _t(i)) && n.setAttribute("class", s);
                        }
                return this;
            },
            removeClass: function (t) {
                var e,
                    n,
                    i,
                    o,
                    r,
                    s,
                    a = 0;
                if (y(t))
                    return this.each(function (e) {
                        E(this).removeClass(t.call(this, e, wt(this)));
                    });
                if (!arguments.length) return this.attr("class", "");
                if ((e = xt(t)).length)
                    for (; (n = this[a++]); )
                        if (
                            ((s = wt(n)),
                            (i = 1 === n.nodeType && " " + _t(s) + " "))
                        ) {
                            for (r = 0; (o = e[r++]); )
                                for (; -1 < i.indexOf(" " + o + " "); )
                                    i = i.replace(" " + o + " ", " ");
                            s !== (s = _t(i)) && n.setAttribute("class", s);
                        }
                return this;
            },
            toggleClass: function (o, t) {
                var r = typeof o,
                    s = "string" == r || Array.isArray(o);
                return "boolean" == typeof t && s
                    ? t
                        ? this.addClass(o)
                        : this.removeClass(o)
                    : y(o)
                    ? this.each(function (e) {
                          E(this).toggleClass(o.call(this, e, wt(this), t), t);
                      })
                    : this.each(function () {
                          var e, t, n, i;
                          if (s)
                              for (
                                  t = 0, n = E(this), i = xt(o);
                                  (e = i[t++]);

                              )
                                  n.hasClass(e)
                                      ? n.removeClass(e)
                                      : n.addClass(e);
                          else
                              (void 0 !== o && "boolean" != r) ||
                                  ((e = wt(this)) &&
                                      v.set(this, "__className__", e),
                                  this.setAttribute &&
                                      this.setAttribute(
                                          "class",
                                          (!e &&
                                              !1 !== o &&
                                              v.get(this, "__className__")) ||
                                              ""
                                      ));
                      });
            },
            hasClass: function (e) {
                for (var t, n = 0, i = " " + e + " "; (t = this[n++]); )
                    if (
                        1 === t.nodeType &&
                        -1 < (" " + _t(wt(t)) + " ").indexOf(i)
                    )
                        return !0;
                return !1;
            },
        });
    function Et(e) {
        e.stopPropagation();
    }
    var Tt = /\r/g,
        kt =
            (E.fn.extend({
                val: function (t) {
                    var n,
                        e,
                        i,
                        o = this[0];
                    return arguments.length
                        ? ((i = y(t)),
                          this.each(function (e) {
                              1 === this.nodeType &&
                                  (null ==
                                  (e = i ? t.call(this, e, E(this).val()) : t)
                                      ? (e = "")
                                      : "number" == typeof e
                                      ? (e += "")
                                      : Array.isArray(e) &&
                                        (e = E.map(e, function (e) {
                                            return null == e ? "" : e + "";
                                        })),
                                  ((n =
                                      E.valHooks[this.type] ||
                                      E.valHooks[
                                          this.nodeName.toLowerCase()
                                      ]) &&
                                      "set" in n &&
                                      void 0 !== n.set(this, e, "value")) ||
                                      (this.value = e));
                          }))
                        : o
                        ? (n =
                              E.valHooks[o.type] ||
                              E.valHooks[o.nodeName.toLowerCase()]) &&
                          "get" in n &&
                          void 0 !== (e = n.get(o, "value"))
                            ? e
                            : "string" == typeof (e = o.value)
                            ? e.replace(Tt, "")
                            : null == e
                            ? ""
                            : e
                        : void 0;
                },
            }),
            E.extend({
                valHooks: {
                    option: {
                        get: function (e) {
                            var t = E.find.attr(e, "value");
                            return null != t ? t : _t(E.text(e));
                        },
                    },
                    select: {
                        get: function (e) {
                            for (
                                var t,
                                    n = e.options,
                                    i = e.selectedIndex,
                                    o = "select-one" === e.type,
                                    r = o ? null : [],
                                    s = o ? i + 1 : n.length,
                                    a = i < 0 ? s : o ? i : 0;
                                a < s;
                                a++
                            )
                                if (
                                    ((t = n[a]).selected || a === i) &&
                                    !t.disabled &&
                                    (!t.parentNode.disabled ||
                                        !l(t.parentNode, "optgroup"))
                                ) {
                                    if (((t = E(t).val()), o)) return t;
                                    r.push(t);
                                }
                            return r;
                        },
                        set: function (e, t) {
                            for (
                                var n,
                                    i,
                                    o = e.options,
                                    r = E.makeArray(t),
                                    s = o.length;
                                s--;

                            )
                                ((i = o[s]).selected =
                                    -1 <
                                    E.inArray(E.valHooks.option.get(i), r)) &&
                                    (n = !0);
                            return n || (e.selectedIndex = -1), r;
                        },
                    },
                },
            }),
            E.each(["radio", "checkbox"], function () {
                (E.valHooks[this] = {
                    set: function (e, t) {
                        if (Array.isArray(t))
                            return (e.checked = -1 < E.inArray(E(e).val(), t));
                    },
                }),
                    g.checkOn ||
                        (E.valHooks[this].get = function (e) {
                            return null === e.getAttribute("value")
                                ? "on"
                                : e.value;
                        });
            }),
            (g.focusin = "onfocusin" in w),
            /^(?:focusinfocus|focusoutblur)$/),
        Ct =
            (E.extend(E.event, {
                trigger: function (e, t, n, i) {
                    var u,
                        o,
                        h,
                        r,
                        s,
                        a,
                        d,
                        f = [n || x],
                        l = T.call(e, "type") ? e.type : e,
                        p = T.call(e, "namespace")
                            ? e.namespace.split(".")
                            : [],
                        c = (d = o = n = n || x);
                    if (
                        3 !== n.nodeType &&
                        8 !== n.nodeType &&
                        !kt.test(l + E.event.triggered) &&
                        (-1 < l.indexOf(".") &&
                            ((l = (p = l.split(".")).shift()), p.sort()),
                        (r = l.indexOf(":") < 0 && "on" + l),
                        ((e = e[E.expando]
                            ? e
                            : new E.Event(
                                  l,
                                  "object" == typeof e && e
                              )).isTrigger = i ? 2 : 3),
                        (e.namespace = p.join(".")),
                        (e.rnamespace = e.namespace
                            ? new RegExp(
                                  "(^|\\.)" +
                                      p.join("\\.(?:.*\\.|)") +
                                      "(\\.|$)"
                              )
                            : null),
                        (e.result = void 0),
                        e.target || (e.target = n),
                        (t = null == t ? [e] : E.makeArray(t, [e])),
                        (a = E.event.special[l] || {}),
                        i || !a.trigger || !1 !== a.trigger.apply(n, t))
                    ) {
                        if (!i && !a.noBubble && !b(n)) {
                            for (
                                h = a.delegateType || l,
                                    kt.test(h + l) || (c = c.parentNode);
                                c;
                                c = c.parentNode
                            )
                                f.push(c), (o = c);
                            o === (n.ownerDocument || x) &&
                                f.push(o.defaultView || o.parentWindow || w);
                        }
                        for (u = 0; (c = f[u++]) && !e.isPropagationStopped(); )
                            (d = c),
                                (e.type = 1 < u ? h : a.bindType || l),
                                (s =
                                    (v.get(c, "events") || Object.create(null))[
                                        e.type
                                    ] && v.get(c, "handle")) && s.apply(c, t),
                                (s = r && c[r]) &&
                                    s.apply &&
                                    Q(c) &&
                                    ((e.result = s.apply(c, t)),
                                    !1 === e.result && e.preventDefault());
                        return (
                            (e.type = l),
                            i ||
                                e.isDefaultPrevented() ||
                                (a._default &&
                                    !1 !== a._default.apply(f.pop(), t)) ||
                                !Q(n) ||
                                (r &&
                                    y(n[l]) &&
                                    !b(n) &&
                                    ((o = n[r]) && (n[r] = null),
                                    (E.event.triggered = l),
                                    e.isPropagationStopped() &&
                                        d.addEventListener(l, Et),
                                    n[l](),
                                    e.isPropagationStopped() &&
                                        d.removeEventListener(l, Et),
                                    (E.event.triggered = void 0),
                                    o && (n[r] = o))),
                            e.result
                        );
                    }
                },
                simulate: function (e, t, n) {
                    n = E.extend(new E.Event(), n, {
                        type: e,
                        isSimulated: !0,
                    });
                    E.event.trigger(n, null, t);
                },
            }),
            E.fn.extend({
                trigger: function (e, t) {
                    return this.each(function () {
                        E.event.trigger(e, t, this);
                    });
                },
                triggerHandler: function (e, t) {
                    var n = this[0];
                    if (n) return E.event.trigger(e, t, n, !0);
                },
            }),
            g.focusin ||
                E.each({ focus: "focusin", blur: "focusout" }, function (n, i) {
                    function o(e) {
                        E.event.simulate(i, e.target, E.event.fix(e));
                    }
                    E.event.special[i] = {
                        setup: function () {
                            var e = this.ownerDocument || this.document || this,
                                t = v.access(e, i);
                            t || e.addEventListener(n, o, !0),
                                v.access(e, i, (t || 0) + 1);
                        },
                        teardown: function () {
                            var e = this.ownerDocument || this.document || this,
                                t = v.access(e, i) - 1;
                            t
                                ? v.access(e, i, t)
                                : (e.removeEventListener(n, o, !0),
                                  v.remove(e, i));
                        },
                    };
                }),
            w.location),
        At = { guid: Date.now() },
        St = /\?/,
        Lt =
            ((E.parseXML = function (e) {
                var t, n;
                if (!e || "string" != typeof e) return null;
                try {
                    t = new w.DOMParser().parseFromString(e, "text/xml");
                } catch (e) {}
                return (
                    (n = t && t.getElementsByTagName("parsererror")[0]),
                    (t && !n) ||
                        E.error(
                            "Invalid XML: " +
                                (n
                                    ? E.map(n.childNodes, function (e) {
                                          return e.textContent;
                                      }).join("\n")
                                    : e)
                        ),
                    t
                );
            }),
            /\[\]$/),
        Dt = /\r?\n/g,
        Nt = /^(?:submit|button|image|reset|file)$/i,
        Ot = /^(?:input|select|textarea|keygen)/i;
    (E.param = function (e, t) {
        function n(e, t) {
            (t = y(t) ? t() : t),
                (o[o.length] =
                    encodeURIComponent(e) +
                    "=" +
                    encodeURIComponent(null == t ? "" : t));
        }
        var i,
            o = [];
        if (null == e) return "";
        if (Array.isArray(e) || (e.jquery && !E.isPlainObject(e)))
            E.each(e, function () {
                n(this.name, this.value);
            });
        else
            for (i in e)
                !(function n(i, e, o, r) {
                    if (Array.isArray(e))
                        E.each(e, function (e, t) {
                            o || Lt.test(i)
                                ? r(i, t)
                                : n(
                                      i +
                                          "[" +
                                          ("object" == typeof t && null != t
                                              ? e
                                              : "") +
                                          "]",
                                      t,
                                      o,
                                      r
                                  );
                        });
                    else if (o || "object" !== p(e)) r(i, e);
                    else for (var t in e) n(i + "[" + t + "]", e[t], o, r);
                })(i, e[i], t, n);
        return o.join("&");
    }),
        E.fn.extend({
            serialize: function () {
                return E.param(this.serializeArray());
            },
            serializeArray: function () {
                return this.map(function () {
                    var e = E.prop(this, "elements");
                    return e ? E.makeArray(e) : this;
                })
                    .filter(function () {
                        var e = this.type;
                        return (
                            this.name &&
                            !E(this).is(":disabled") &&
                            Ot.test(this.nodeName) &&
                            !Nt.test(e) &&
                            (this.checked || !ce.test(e))
                        );
                    })
                    .map(function (e, t) {
                        var n = E(this).val();
                        return null == n
                            ? null
                            : Array.isArray(n)
                            ? E.map(n, function (e) {
                                  return {
                                      name: t.name,
                                      value: e.replace(Dt, "\r\n"),
                                  };
                              })
                            : { name: t.name, value: n.replace(Dt, "\r\n") };
                    })
                    .get();
            },
        });
    var jt = /%20/g,
        It = /#.*$/,
        Pt = /([?&])_=[^&]*/,
        Ht = /^(.*?):[ \t]*([^\r\n]*)$/gm,
        Mt = /^(?:GET|HEAD)$/,
        qt = /^\/\//,
        Rt = {},
        Bt = {},
        Wt = "*/".concat("*"),
        Ft = x.createElement("a");
    function zt(r) {
        return function (e, t) {
            "string" != typeof e && ((t = e), (e = "*"));
            var n,
                i = 0,
                o = e.toLowerCase().match(M) || [];
            if (y(t))
                for (; (n = o[i++]); )
                    "+" === n[0]
                        ? ((n = n.slice(1) || "*"),
                          (r[n] = r[n] || []).unshift(t))
                        : (r[n] = r[n] || []).push(t);
        };
    }
    function $t(t, i, o, r) {
        var s = {},
            a = t === Bt;
        function l(e) {
            var n;
            return (
                (s[e] = !0),
                E.each(t[e] || [], function (e, t) {
                    t = t(i, o, r);
                    return "string" != typeof t || a || s[t]
                        ? a
                            ? !(n = t)
                            : void 0
                        : (i.dataTypes.unshift(t), l(t), !1);
                }),
                n
            );
        }
        return l(i.dataTypes[0]) || (!s["*"] && l("*"));
    }
    function Ut(e, t) {
        var n,
            i,
            o = E.ajaxSettings.flatOptions || {};
        for (n in t) void 0 !== t[n] && ((o[n] ? e : (i = i || {}))[n] = t[n]);
        return i && E.extend(!0, e, i), e;
    }
    (Ft.href = Ct.href),
        E.extend({
            active: 0,
            lastModified: {},
            etag: {},
            ajaxSettings: {
                url: Ct.href,
                type: "GET",
                isLocal:
                    /^(?:about|app|app-storage|.+-extension|file|res|widget):$/.test(
                        Ct.protocol
                    ),
                global: !0,
                processData: !0,
                async: !0,
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                accepts: {
                    "*": Wt,
                    text: "text/plain",
                    html: "text/html",
                    xml: "application/xml, text/xml",
                    json: "application/json, text/javascript",
                },
                contents: { xml: /\bxml\b/, html: /\bhtml/, json: /\bjson\b/ },
                responseFields: {
                    xml: "responseXML",
                    text: "responseText",
                    json: "responseJSON",
                },
                converters: {
                    "* text": String,
                    "text html": !0,
                    "text json": JSON.parse,
                    "text xml": E.parseXML,
                },
                flatOptions: { url: !0, context: !0 },
            },
            ajaxSetup: function (e, t) {
                return t ? Ut(Ut(e, E.ajaxSettings), t) : Ut(E.ajaxSettings, e);
            },
            ajaxPrefilter: zt(Rt),
            ajaxTransport: zt(Bt),
            ajax: function (e, t) {
                "object" == typeof e && ((t = e), (e = void 0));
                var l,
                    c,
                    g,
                    n,
                    m,
                    u,
                    h,
                    i,
                    d = E.ajaxSetup({}, (t = t || {})),
                    f = d.context || d,
                    v = d.context && (f.nodeType || f.jquery) ? E(f) : E.event,
                    y = E.Deferred(),
                    b = E.Callbacks("once memory"),
                    _ = d.statusCode || {},
                    o = {},
                    r = {},
                    s = "canceled",
                    p = {
                        readyState: 0,
                        getResponseHeader: function (e) {
                            var t;
                            if (u) {
                                if (!n)
                                    for (n = {}; (t = Ht.exec(g)); )
                                        n[t[1].toLowerCase() + " "] = (
                                            n[t[1].toLowerCase() + " "] || []
                                        ).concat(t[2]);
                                t = n[e.toLowerCase() + " "];
                            }
                            return null == t ? null : t.join(", ");
                        },
                        getAllResponseHeaders: function () {
                            return u ? g : null;
                        },
                        setRequestHeader: function (e, t) {
                            return (
                                null == u &&
                                    ((e = r[e.toLowerCase()] =
                                        r[e.toLowerCase()] || e),
                                    (o[e] = t)),
                                this
                            );
                        },
                        overrideMimeType: function (e) {
                            return null == u && (d.mimeType = e), this;
                        },
                        statusCode: function (e) {
                            if (e)
                                if (u) p.always(e[p.status]);
                                else for (var t in e) _[t] = [_[t], e[t]];
                            return this;
                        },
                        abort: function (e) {
                            e = e || s;
                            return l && l.abort(e), a(0, e), this;
                        },
                    };
                if (
                    (y.promise(p),
                    (d.url = ((e || d.url || Ct.href) + "").replace(
                        qt,
                        Ct.protocol + "//"
                    )),
                    (d.type = t.method || t.type || d.method || d.type),
                    (d.dataTypes = (d.dataType || "*")
                        .toLowerCase()
                        .match(M) || [""]),
                    null == d.crossDomain)
                ) {
                    e = x.createElement("a");
                    try {
                        (e.href = d.url),
                            (e.href = e.href),
                            (d.crossDomain =
                                Ft.protocol + "//" + Ft.host !=
                                e.protocol + "//" + e.host);
                    } catch (e) {
                        d.crossDomain = !0;
                    }
                }
                if (
                    (d.data &&
                        d.processData &&
                        "string" != typeof d.data &&
                        (d.data = E.param(d.data, d.traditional)),
                    $t(Rt, d, t, p),
                    u)
                )
                    return p;
                for (i in ((h = E.event && d.global) &&
                    0 == E.active++ &&
                    E.event.trigger("ajaxStart"),
                (d.type = d.type.toUpperCase()),
                (d.hasContent = !Mt.test(d.type)),
                (c = d.url.replace(It, "")),
                d.hasContent
                    ? d.data &&
                      d.processData &&
                      0 ===
                          (d.contentType || "").indexOf(
                              "application/x-www-form-urlencoded"
                          ) &&
                      (d.data = d.data.replace(jt, "+"))
                    : ((e = d.url.slice(c.length)),
                      d.data &&
                          (d.processData || "string" == typeof d.data) &&
                          ((c += (St.test(c) ? "&" : "?") + d.data),
                          delete d.data),
                      !1 === d.cache &&
                          ((c = c.replace(Pt, "$1")),
                          (e =
                              (St.test(c) ? "&" : "?") + "_=" + At.guid++ + e)),
                      (d.url = c + e)),
                d.ifModified &&
                    (E.lastModified[c] &&
                        p.setRequestHeader(
                            "If-Modified-Since",
                            E.lastModified[c]
                        ),
                    E.etag[c] &&
                        p.setRequestHeader("If-None-Match", E.etag[c])),
                ((d.data && d.hasContent && !1 !== d.contentType) ||
                    t.contentType) &&
                    p.setRequestHeader("Content-Type", d.contentType),
                p.setRequestHeader(
                    "Accept",
                    d.dataTypes[0] && d.accepts[d.dataTypes[0]]
                        ? d.accepts[d.dataTypes[0]] +
                              ("*" !== d.dataTypes[0]
                                  ? ", " + Wt + "; q=0.01"
                                  : "")
                        : d.accepts["*"]
                ),
                d.headers))
                    p.setRequestHeader(i, d.headers[i]);
                if (d.beforeSend && (!1 === d.beforeSend.call(f, p, d) || u))
                    return p.abort();
                if (
                    ((s = "abort"),
                    b.add(d.complete),
                    p.done(d.success),
                    p.fail(d.error),
                    (l = $t(Bt, d, t, p)))
                ) {
                    if (
                        ((p.readyState = 1),
                        h && v.trigger("ajaxSend", [p, d]),
                        u)
                    )
                        return p;
                    d.async &&
                        0 < d.timeout &&
                        (m = w.setTimeout(function () {
                            p.abort("timeout");
                        }, d.timeout));
                    try {
                        (u = !1), l.send(o, a);
                    } catch (e) {
                        if (u) throw e;
                        a(-1, e);
                    }
                } else a(-1, "No Transport");
                function a(e, t, n, i) {
                    var o,
                        r,
                        s,
                        a = t;
                    u ||
                        ((u = !0),
                        m && w.clearTimeout(m),
                        (l = void 0),
                        (g = i || ""),
                        (p.readyState = 0 < e ? 4 : 0),
                        (i = (200 <= e && e < 300) || 304 === e),
                        n &&
                            (s = (function (e, t, n) {
                                for (
                                    var i,
                                        o,
                                        r,
                                        s,
                                        a = e.contents,
                                        l = e.dataTypes;
                                    "*" === l[0];

                                )
                                    l.shift(),
                                        void 0 === i &&
                                            (i =
                                                e.mimeType ||
                                                t.getResponseHeader(
                                                    "Content-Type"
                                                ));
                                if (i)
                                    for (o in a)
                                        if (a[o] && a[o].test(i)) {
                                            l.unshift(o);
                                            break;
                                        }
                                if (l[0] in n) r = l[0];
                                else {
                                    for (o in n) {
                                        if (
                                            !l[0] ||
                                            e.converters[o + " " + l[0]]
                                        ) {
                                            r = o;
                                            break;
                                        }
                                        s = s || o;
                                    }
                                    r = r || s;
                                }
                                if (r) return r !== l[0] && l.unshift(r), n[r];
                            })(d, p, n)),
                        !i &&
                            -1 < E.inArray("script", d.dataTypes) &&
                            E.inArray("json", d.dataTypes) < 0 &&
                            (d.converters["text script"] = function () {}),
                        (s = (function (e, t, n, u) {
                            var i,
                                o,
                                r,
                                s,
                                a,
                                l = {},
                                c = e.dataTypes.slice();
                            if (c[1])
                                for (r in e.converters)
                                    l[r.toLowerCase()] = e.converters[r];
                            for (o = c.shift(); o; )
                                if (
                                    (e.responseFields[o] &&
                                        (n[e.responseFields[o]] = t),
                                    !a &&
                                        u &&
                                        e.dataFilter &&
                                        (t = e.dataFilter(t, e.dataType)),
                                    (a = o),
                                    (o = c.shift()))
                                )
                                    if ("*" === o) o = a;
                                    else if ("*" !== a && a !== o) {
                                        if (
                                            !(r = l[a + " " + o] || l["* " + o])
                                        )
                                            for (i in l)
                                                if (
                                                    (s = i.split(" "))[1] ===
                                                        o &&
                                                    (r =
                                                        l[a + " " + s[0]] ||
                                                        l["* " + s[0]])
                                                ) {
                                                    !0 === r
                                                        ? (r = l[i])
                                                        : !0 !== l[i] &&
                                                          ((o = s[0]),
                                                          c.unshift(s[1]));
                                                    break;
                                                }
                                        if (!0 !== r)
                                            if (r && e.throws) t = r(t);
                                            else
                                                try {
                                                    t = r(t);
                                                } catch (e) {
                                                    return {
                                                        state: "parsererror",
                                                        error: r
                                                            ? e
                                                            : "No conversion from " +
                                                              a +
                                                              " to " +
                                                              o,
                                                    };
                                                }
                                    }
                            return { state: "success", data: t };
                        })(d, s, p, i)),
                        i
                            ? (d.ifModified &&
                                  ((n = p.getResponseHeader("Last-Modified")) &&
                                      (E.lastModified[c] = n),
                                  (n = p.getResponseHeader("etag")) &&
                                      (E.etag[c] = n)),
                              204 === e || "HEAD" === d.type
                                  ? (a = "nocontent")
                                  : 304 === e
                                  ? (a = "notmodified")
                                  : ((a = s.state),
                                    (o = s.data),
                                    (i = !(r = s.error))))
                            : ((r = a),
                              (!e && a) || ((a = "error"), e < 0 && (e = 0))),
                        (p.status = e),
                        (p.statusText = (t || a) + ""),
                        i
                            ? y.resolveWith(f, [o, a, p])
                            : y.rejectWith(f, [p, a, r]),
                        p.statusCode(_),
                        (_ = void 0),
                        h &&
                            v.trigger(i ? "ajaxSuccess" : "ajaxError", [
                                p,
                                d,
                                i ? o : r,
                            ]),
                        b.fireWith(f, [p, a]),
                        h &&
                            (v.trigger("ajaxComplete", [p, d]),
                            --E.active || E.event.trigger("ajaxStop")));
                }
                return p;
            },
            getJSON: function (e, t, n) {
                return E.get(e, t, n, "json");
            },
            getScript: function (e, t) {
                return E.get(e, void 0, t, "script");
            },
        }),
        E.each(["get", "post"], function (e, o) {
            E[o] = function (e, t, n, i) {
                return (
                    y(t) && ((i = i || n), (n = t), (t = void 0)),
                    E.ajax(
                        E.extend(
                            {
                                url: e,
                                type: o,
                                dataType: i,
                                data: t,
                                success: n,
                            },
                            E.isPlainObject(e) && e
                        )
                    )
                );
            };
        }),
        E.ajaxPrefilter(function (e) {
            for (var t in e.headers)
                "content-type" === t.toLowerCase() &&
                    (e.contentType = e.headers[t] || "");
        }),
        (E._evalUrl = function (e, t, n) {
            return E.ajax({
                url: e,
                type: "GET",
                dataType: "script",
                cache: !0,
                async: !1,
                global: !1,
                converters: { "text script": function () {} },
                dataFilter: function (e) {
                    E.globalEval(e, t, n);
                },
            });
        }),
        E.fn.extend({
            wrapAll: function (e) {
                return (
                    this[0] &&
                        (y(e) && (e = e.call(this[0])),
                        (e = E(e, this[0].ownerDocument).eq(0).clone(!0)),
                        this[0].parentNode && e.insertBefore(this[0]),
                        e
                            .map(function () {
                                for (var e = this; e.firstElementChild; )
                                    e = e.firstElementChild;
                                return e;
                            })
                            .append(this)),
                    this
                );
            },
            wrapInner: function (n) {
                return y(n)
                    ? this.each(function (e) {
                          E(this).wrapInner(n.call(this, e));
                      })
                    : this.each(function () {
                          var e = E(this),
                              t = e.contents();
                          t.length ? t.wrapAll(n) : e.append(n);
                      });
            },
            wrap: function (t) {
                var n = y(t);
                return this.each(function (e) {
                    E(this).wrapAll(n ? t.call(this, e) : t);
                });
            },
            unwrap: function (e) {
                return (
                    this.parent(e)
                        .not("body")
                        .each(function () {
                            E(this).replaceWith(this.childNodes);
                        }),
                    this
                );
            },
        }),
        (E.expr.pseudos.hidden = function (e) {
            return !E.expr.pseudos.visible(e);
        }),
        (E.expr.pseudos.visible = function (e) {
            return !!(
                e.offsetWidth ||
                e.offsetHeight ||
                e.getClientRects().length
            );
        }),
        (E.ajaxSettings.xhr = function () {
            try {
                return new w.XMLHttpRequest();
            } catch (e) {}
        });
    var Xt = { 0: 200, 1223: 204 },
        Vt = E.ajaxSettings.xhr(),
        Yt =
            ((g.cors = !!Vt && "withCredentials" in Vt),
            (g.ajax = Vt = !!Vt),
            E.ajaxTransport(function (o) {
                var r, s;
                if (g.cors || (Vt && !o.crossDomain))
                    return {
                        send: function (e, t) {
                            var n,
                                i = o.xhr();
                            if (
                                (i.open(
                                    o.type,
                                    o.url,
                                    o.async,
                                    o.username,
                                    o.password
                                ),
                                o.xhrFields)
                            )
                                for (n in o.xhrFields) i[n] = o.xhrFields[n];
                            for (n in (o.mimeType &&
                                i.overrideMimeType &&
                                i.overrideMimeType(o.mimeType),
                            o.crossDomain ||
                                e["X-Requested-With"] ||
                                (e["X-Requested-With"] = "XMLHttpRequest"),
                            e))
                                i.setRequestHeader(n, e[n]);
                            (r = function (e) {
                                return function () {
                                    r &&
                                        ((r =
                                            s =
                                            i.onload =
                                            i.onerror =
                                            i.onabort =
                                            i.ontimeout =
                                            i.onreadystatechange =
                                                null),
                                        "abort" === e
                                            ? i.abort()
                                            : "error" === e
                                            ? "number" != typeof i.status
                                                ? t(0, "error")
                                                : t(i.status, i.statusText)
                                            : t(
                                                  Xt[i.status] || i.status,
                                                  i.statusText,
                                                  "text" !==
                                                      (i.responseType ||
                                                          "text") ||
                                                      "string" !=
                                                          typeof i.responseText
                                                      ? { binary: i.response }
                                                      : {
                                                            text: i.responseText,
                                                        },
                                                  i.getAllResponseHeaders()
                                              ));
                                };
                            }),
                                (i.onload = r()),
                                (s = i.onerror = i.ontimeout = r("error")),
                                void 0 !== i.onabort
                                    ? (i.onabort = s)
                                    : (i.onreadystatechange = function () {
                                          4 === i.readyState &&
                                              w.setTimeout(function () {
                                                  r && s();
                                              });
                                      }),
                                (r = r("abort"));
                            try {
                                i.send((o.hasContent && o.data) || null);
                            } catch (e) {
                                if (r) throw e;
                            }
                        },
                        abort: function () {
                            r && r();
                        },
                    };
            }),
            E.ajaxPrefilter(function (e) {
                e.crossDomain && (e.contents.script = !1);
            }),
            E.ajaxSetup({
                accepts: {
                    script: "text/javascript, application/javascript, application/ecmascript, application/x-ecmascript",
                },
                contents: { script: /\b(?:java|ecma)script\b/ },
                converters: {
                    "text script": function (e) {
                        return E.globalEval(e), e;
                    },
                },
            }),
            E.ajaxPrefilter("script", function (e) {
                void 0 === e.cache && (e.cache = !1),
                    e.crossDomain && (e.type = "GET");
            }),
            E.ajaxTransport("script", function (n) {
                var i, o;
                if (n.crossDomain || n.scriptAttrs)
                    return {
                        send: function (e, t) {
                            (i = E("<script>")
                                .attr(n.scriptAttrs || {})
                                .prop({ charset: n.scriptCharset, src: n.url })
                                .on(
                                    "load error",
                                    (o = function (e) {
                                        i.remove(),
                                            (o = null),
                                            e &&
                                                t(
                                                    "error" === e.type
                                                        ? 404
                                                        : 200,
                                                    e.type
                                                );
                                    })
                                )),
                                x.head.appendChild(i[0]);
                        },
                        abort: function () {
                            o && o();
                        },
                    };
            }),
            []),
        Qt = /(=)\?(?=&|$)|\?\?/,
        Gt =
            (E.ajaxSetup({
                jsonp: "callback",
                jsonpCallback: function () {
                    var e = Yt.pop() || E.expando + "_" + At.guid++;
                    return (this[e] = !0), e;
                },
            }),
            E.ajaxPrefilter("json jsonp", function (e, t, n) {
                var i,
                    o,
                    r,
                    s =
                        !1 !== e.jsonp &&
                        (Qt.test(e.url)
                            ? "url"
                            : "string" == typeof e.data &&
                              0 ===
                                  (e.contentType || "").indexOf(
                                      "application/x-www-form-urlencoded"
                                  ) &&
                              Qt.test(e.data) &&
                              "data");
                if (s || "jsonp" === e.dataTypes[0])
                    return (
                        (i = e.jsonpCallback =
                            y(e.jsonpCallback)
                                ? e.jsonpCallback()
                                : e.jsonpCallback),
                        s
                            ? (e[s] = e[s].replace(Qt, "$1" + i))
                            : !1 !== e.jsonp &&
                              (e.url +=
                                  (St.test(e.url) ? "&" : "?") +
                                  e.jsonp +
                                  "=" +
                                  i),
                        (e.converters["script json"] = function () {
                            return r || E.error(i + " was not called"), r[0];
                        }),
                        (e.dataTypes[0] = "json"),
                        (o = w[i]),
                        (w[i] = function () {
                            r = arguments;
                        }),
                        n.always(function () {
                            void 0 === o ? E(w).removeProp(i) : (w[i] = o),
                                e[i] &&
                                    ((e.jsonpCallback = t.jsonpCallback),
                                    Yt.push(i)),
                                r && y(o) && o(r[0]),
                                (r = o = void 0);
                        }),
                        "script"
                    );
            }),
            (g.createHTMLDocument =
                (((e = x.implementation.createHTMLDocument("").body).innerHTML =
                    "<form></form><form></form>"),
                2 === e.childNodes.length)),
            (E.parseHTML = function (e, t, n) {
                return "string" != typeof e
                    ? []
                    : ("boolean" == typeof t && ((n = t), (t = !1)),
                      t ||
                          (g.createHTMLDocument
                              ? (((i = (t =
                                    x.implementation.createHTMLDocument(
                                        ""
                                    )).createElement("base")).href =
                                    x.location.href),
                                t.head.appendChild(i))
                              : (t = x)),
                      (i = !n && []),
                      (n = D.exec(e))
                          ? [t.createElement(n[1])]
                          : ((n = ge([e], t, i)),
                            i && i.length && E(i).remove(),
                            E.merge([], n.childNodes)));
                var i;
            }),
            (E.fn.load = function (e, t, n) {
                var i,
                    o,
                    r,
                    s = this,
                    a = e.indexOf(" ");
                return (
                    -1 < a && ((i = _t(e.slice(a))), (e = e.slice(0, a))),
                    y(t)
                        ? ((n = t), (t = void 0))
                        : t && "object" == typeof t && (o = "POST"),
                    0 < s.length &&
                        E.ajax({
                            url: e,
                            type: o || "GET",
                            dataType: "html",
                            data: t,
                        })
                            .done(function (e) {
                                (r = arguments),
                                    s.html(
                                        i
                                            ? E("<div>")
                                                  .append(E.parseHTML(e))
                                                  .find(i)
                                            : e
                                    );
                            })
                            .always(
                                n &&
                                    function (e, t) {
                                        s.each(function () {
                                            n.apply(
                                                this,
                                                r || [e.responseText, t, e]
                                            );
                                        });
                                    }
                            ),
                    this
                );
            }),
            (E.expr.pseudos.animated = function (t) {
                return E.grep(E.timers, function (e) {
                    return t === e.elem;
                }).length;
            }),
            (E.offset = {
                setOffset: function (e, t, n) {
                    var i,
                        o,
                        r,
                        s,
                        a = E.css(e, "position"),
                        l = E(e),
                        c = {};
                    "static" === a && (e.style.position = "relative"),
                        (r = l.offset()),
                        (i = E.css(e, "top")),
                        (s = E.css(e, "left")),
                        (a =
                            ("absolute" === a || "fixed" === a) &&
                            -1 < (i + s).indexOf("auto")
                                ? ((o = (a = l.position()).top), a.left)
                                : ((o = parseFloat(i) || 0),
                                  parseFloat(s) || 0)),
                        null !=
                            (t = y(t) ? t.call(e, n, E.extend({}, r)) : t)
                                .top && (c.top = t.top - r.top + o),
                        null != t.left && (c.left = t.left - r.left + a),
                        "using" in t ? t.using.call(e, c) : l.css(c);
                },
            }),
            E.fn.extend({
                offset: function (t) {
                    if (arguments.length)
                        return void 0 === t
                            ? this
                            : this.each(function (e) {
                                  E.offset.setOffset(this, t, e);
                              });
                    var e,
                        n = this[0];
                    return n
                        ? n.getClientRects().length
                            ? ((e = n.getBoundingClientRect()),
                              (n = n.ownerDocument.defaultView),
                              {
                                  top: e.top + n.pageYOffset,
                                  left: e.left + n.pageXOffset,
                              })
                            : { top: 0, left: 0 }
                        : void 0;
                },
                position: function () {
                    if (this[0]) {
                        var e,
                            t,
                            n,
                            i = this[0],
                            o = { top: 0, left: 0 };
                        if ("fixed" === E.css(i, "position"))
                            t = i.getBoundingClientRect();
                        else {
                            for (
                                t = this.offset(),
                                    n = i.ownerDocument,
                                    e = i.offsetParent || n.documentElement;
                                e &&
                                (e === n.body || e === n.documentElement) &&
                                "static" === E.css(e, "position");

                            )
                                e = e.parentNode;
                            e &&
                                e !== i &&
                                1 === e.nodeType &&
                                (((o = E(e).offset()).top += E.css(
                                    e,
                                    "borderTopWidth",
                                    !0
                                )),
                                (o.left += E.css(e, "borderLeftWidth", !0)));
                        }
                        return {
                            top: t.top - o.top - E.css(i, "marginTop", !0),
                            left: t.left - o.left - E.css(i, "marginLeft", !0),
                        };
                    }
                },
                offsetParent: function () {
                    return this.map(function () {
                        for (
                            var e = this.offsetParent;
                            e && "static" === E.css(e, "position");

                        )
                            e = e.offsetParent;
                        return e || ie;
                    });
                },
            }),
            E.each(
                { scrollLeft: "pageXOffset", scrollTop: "pageYOffset" },
                function (t, o) {
                    var r = "pageYOffset" === o;
                    E.fn[t] = function (e) {
                        return $(
                            this,
                            function (e, t, n) {
                                var i;
                                if (
                                    (b(e)
                                        ? (i = e)
                                        : 9 === e.nodeType &&
                                          (i = e.defaultView),
                                    void 0 === n)
                                )
                                    return i ? i[o] : e[t];
                                i
                                    ? i.scrollTo(
                                          r ? i.pageXOffset : n,
                                          r ? n : i.pageYOffset
                                      )
                                    : (e[t] = n);
                            },
                            t,
                            e,
                            arguments.length
                        );
                    };
                }
            ),
            E.each(["top", "left"], function (e, n) {
                E.cssHooks[n] = Xe(g.pixelPosition, function (e, t) {
                    if (t)
                        return (
                            (t = Ue(e, n)),
                            We.test(t) ? E(e).position()[n] + "px" : t
                        );
                });
            }),
            E.each({ Height: "height", Width: "width" }, function (s, a) {
                E.each(
                    { padding: "inner" + s, content: a, "": "outer" + s },
                    function (i, r) {
                        E.fn[r] = function (e, t) {
                            var n =
                                    arguments.length &&
                                    (i || "boolean" != typeof e),
                                o =
                                    i ||
                                    (!0 === e || !0 === t
                                        ? "margin"
                                        : "border");
                            return $(
                                this,
                                function (e, t, n) {
                                    var i;
                                    return b(e)
                                        ? 0 === r.indexOf("outer")
                                            ? e["inner" + s]
                                            : e.document.documentElement[
                                                  "client" + s
                                              ]
                                        : 9 === e.nodeType
                                        ? ((i = e.documentElement),
                                          Math.max(
                                              e.body["scroll" + s],
                                              i["scroll" + s],
                                              e.body["offset" + s],
                                              i["offset" + s],
                                              i["client" + s]
                                          ))
                                        : void 0 === n
                                        ? E.css(e, t, o)
                                        : E.style(e, t, n, o);
                                },
                                a,
                                n ? e : void 0,
                                n
                            );
                        };
                    }
                );
            }),
            E.each(
                [
                    "ajaxStart",
                    "ajaxStop",
                    "ajaxComplete",
                    "ajaxError",
                    "ajaxSuccess",
                    "ajaxSend",
                ],
                function (e, t) {
                    E.fn[t] = function (e) {
                        return this.on(t, e);
                    };
                }
            ),
            E.fn.extend({
                bind: function (e, t, n) {
                    return this.on(e, null, t, n);
                },
                unbind: function (e, t) {
                    return this.off(e, null, t);
                },
                delegate: function (e, t, n, i) {
                    return this.on(t, e, n, i);
                },
                undelegate: function (e, t, n) {
                    return 1 === arguments.length
                        ? this.off(e, "**")
                        : this.off(t, e || "**", n);
                },
                hover: function (e, t) {
                    return this.mouseenter(e).mouseleave(t || e);
                },
            }),
            E.each(
                "blur focus focusin focusout resize scroll click dblclick mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave change select submit keydown keypress keyup contextmenu".split(
                    " "
                ),
                function (e, n) {
                    E.fn[n] = function (e, t) {
                        return 0 < arguments.length
                            ? this.on(n, null, e, t)
                            : this.trigger(n);
                    };
                }
            ),
            /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g),
        Kt =
            ((E.proxy = function (e, t) {
                var n, i;
                if (
                    ("string" == typeof t && ((i = e[t]), (t = e), (e = i)),
                    y(e))
                )
                    return (
                        (n = c.call(arguments, 2)),
                        ((i = function () {
                            return e.apply(
                                t || this,
                                n.concat(c.call(arguments))
                            );
                        }).guid = e.guid =
                            e.guid || E.guid++),
                        i
                    );
            }),
            (E.holdReady = function (e) {
                e ? E.readyWait++ : E.ready(!0);
            }),
            (E.isArray = Array.isArray),
            (E.parseJSON = JSON.parse),
            (E.nodeName = l),
            (E.isFunction = y),
            (E.isWindow = b),
            (E.camelCase = Y),
            (E.type = p),
            (E.now = Date.now),
            (E.isNumeric = function (e) {
                var t = E.type(e);
                return (
                    ("number" === t || "string" === t) &&
                    !isNaN(e - parseFloat(e))
                );
            }),
            (E.trim = function (e) {
                return null == e ? "" : (e + "").replace(Gt, "");
            }),
            "function" == typeof define &&
                define.amd &&
                define("jquery", [], function () {
                    return E;
                }),
            w.jQuery),
        Jt = w.$;
    return (
        (E.noConflict = function (e) {
            return (
                w.$ === E && (w.$ = Jt),
                e && w.jQuery === E && (w.jQuery = Kt),
                E
            );
        }),
        void 0 === t && (w.jQuery = w.$ = E),
        E
    );
}),
    (function (e, t) {
        "object" == typeof exports && "undefined" != typeof module
            ? (module.exports = t())
            : "function" == typeof define && define.amd
            ? define(t)
            : ((e =
                  "undefined" != typeof globalThis
                      ? globalThis
                      : e || self).bootstrap = t());
    })(this, function () {
        "use strict";
        const s = 1e3,
            a = "transitionend",
            n = (t) => {
                let n = t.getAttribute("data-bs-target");
                if (!n || "#" === n) {
                    let e = t.getAttribute("href");
                    if (!e || (!e.includes("#") && !e.startsWith(".")))
                        return null;
                    e.includes("#") &&
                        !e.startsWith("#") &&
                        (e = "#" + e.split("#")[1]),
                        (n = e && "#" !== e ? e.trim() : null);
                }
                return n;
            },
            l = (e) => {
                e = n(e);
                return e && document.querySelector(e) ? e : null;
            },
            c = (e) => {
                e = n(e);
                return e ? document.querySelector(e) : null;
            },
            u = (e) => {
                e.dispatchEvent(new Event(a));
            },
            d = (e) =>
                !(!e || "object" != typeof e) &&
                void 0 !== (e = void 0 !== e.jquery ? e[0] : e).nodeType,
            o = (e) =>
                d(e)
                    ? e.jquery
                        ? e[0]
                        : e
                    : "string" == typeof e && 0 < e.length
                    ? document.querySelector(e)
                    : null,
            f = (i, o, r) => {
                Object.keys(r).forEach((e) => {
                    var t = r[e],
                        n = o[e],
                        n =
                            n && d(n)
                                ? "element"
                                : null == (n = n)
                                ? "" + n
                                : {}.toString
                                      .call(n)
                                      .match(/\s([a-z]+)/i)[1]
                                      .toLowerCase();
                    if (!new RegExp(t).test(n))
                        throw new TypeError(
                            i.toUpperCase() +
                                `: Option "${e}" provided type "${n}" but expected type "${t}".`
                        );
                });
            },
            p = (e) =>
                !(!d(e) || 0 === e.getClientRects().length) &&
                "visible" ===
                    getComputedStyle(e).getPropertyValue("visibility"),
            g = (e) =>
                !e ||
                e.nodeType !== Node.ELEMENT_NODE ||
                !!e.classList.contains("disabled") ||
                (void 0 !== e.disabled
                    ? e.disabled
                    : e.hasAttribute("disabled") &&
                      "false" !== e.getAttribute("disabled")),
            m = (e) => {
                return document.documentElement.attachShadow
                    ? "function" == typeof e.getRootNode
                        ? (t = e.getRootNode()) instanceof ShadowRoot
                            ? t
                            : null
                        : e instanceof ShadowRoot
                        ? e
                        : e.parentNode
                        ? m(e.parentNode)
                        : null
                    : null;
                var t;
            },
            y = () => {},
            b = (e) => {
                e.offsetHeight;
            },
            _ = () => {
                var e = window["jQuery"];
                return e && !document.body.hasAttribute("data-bs-no-jquery")
                    ? e
                    : null;
            },
            w = [],
            i = () => "rtl" === document.documentElement.dir;
        var x = (i) => {
            var e;
            (e = () => {
                const e = _();
                if (e) {
                    const t = i.NAME,
                        n = e.fn[t];
                    (e.fn[t] = i.jQueryInterface),
                        (e.fn[t].Constructor = i),
                        (e.fn[t].noConflict = () => (
                            (e.fn[t] = n), i.jQueryInterface
                        ));
                }
            }),
                "loading" === document.readyState
                    ? (w.length ||
                          document.addEventListener("DOMContentLoaded", () => {
                              w.forEach((e) => e());
                          }),
                      w.push(e))
                    : e();
        };
        const E = (e) => {
                "function" == typeof e && e();
            },
            T = (n, i, e = !0) => {
                if (e) {
                    e =
                        ((e) => {
                            if (!e) return 0;
                            let { transitionDuration: t, transitionDelay: n } =
                                window.getComputedStyle(e);
                            var e = Number.parseFloat(t),
                                i = Number.parseFloat(n);
                            return e || i
                                ? ((t = t.split(",")[0]),
                                  (n = n.split(",")[0]),
                                  (Number.parseFloat(t) +
                                      Number.parseFloat(n)) *
                                      s)
                                : 0;
                        })(i) + 5;
                    let t = !1;
                    const o = ({ target: e }) => {
                        e === i &&
                            ((t = !0), i.removeEventListener(a, o), E(n));
                    };
                    i.addEventListener(a, o),
                        setTimeout(() => {
                            t || u(i);
                        }, e);
                } else E(n);
            },
            k = (e, t, n, i) => {
                let o = e.indexOf(t);
                if (-1 === o) return e[!n && i ? e.length - 1 : 0];
                t = e.length;
                return (
                    (o += n ? 1 : -1),
                    i && (o = (o + t) % t),
                    e[Math.max(0, Math.min(o, t - 1))]
                );
            },
            C = /[^.]*(?=\..*)\.|.*/,
            N = /\..*/,
            O = /::\d+$/,
            j = {};
        let I = 1;
        const P = { mouseenter: "mouseover", mouseleave: "mouseout" },
            H = /^(mouseenter|mouseleave)/i,
            M = new Set([
                "click",
                "dblclick",
                "mouseup",
                "mousedown",
                "contextmenu",
                "mousewheel",
                "DOMMouseScroll",
                "mouseover",
                "mouseout",
                "mousemove",
                "selectstart",
                "selectend",
                "keydown",
                "keypress",
                "keyup",
                "orientationchange",
                "touchstart",
                "touchmove",
                "touchend",
                "touchcancel",
                "pointerdown",
                "pointermove",
                "pointerup",
                "pointerleave",
                "pointercancel",
                "gesturestart",
                "gesturechange",
                "gestureend",
                "focus",
                "blur",
                "change",
                "reset",
                "select",
                "submit",
                "focusin",
                "focusout",
                "load",
                "unload",
                "beforeunload",
                "resize",
                "move",
                "DOMContentLoaded",
                "readystatechange",
                "error",
                "abort",
                "scroll",
            ]);
        function q(e, t) {
            return (t && t + "::" + I++) || e.uidEvent || I++;
        }
        function R(e) {
            var t = q(e);
            return (e.uidEvent = t), (j[t] = j[t] || {}), j[t];
        }
        function B(n, i, o = null) {
            var r = Object.keys(n);
            for (let e = 0, t = r.length; e < t; e++) {
                var s = n[r[e]];
                if (s.originalHandler === i && s.delegationSelector === o)
                    return s;
            }
            return null;
        }
        function W(e, t, n) {
            var i = "string" == typeof t,
                n = i ? n : t;
            let o = $(e);
            t = M.has(o);
            return [i, n, (o = t ? o : e)];
        }
        function F(e, t, n, i, u) {
            if ("string" == typeof t && e) {
                n || ((n = i), (i = null)),
                    H.test(t) &&
                        ((o = (t) =>
                            function (e) {
                                if (
                                    !e.relatedTarget ||
                                    (e.relatedTarget !== e.delegateTarget &&
                                        !e.delegateTarget.contains(
                                            e.relatedTarget
                                        ))
                                )
                                    return t.call(this, e);
                            }),
                        i ? (i = o(i)) : (n = o(n)));
                var [o, r, s] = W(t, n, i);
                const g = R(e),
                    m = g[s] || (g[s] = {}),
                    l = B(m, r, o ? n : null);
                if (l) l.oneOff = l.oneOff && u;
                else {
                    var a,
                        h,
                        d,
                        f,
                        p,
                        t = q(r, t.replace(C, ""));
                    const c = o
                        ? ((d = e),
                          (f = n),
                          (p = i),
                          function n(i) {
                              var o = d.querySelectorAll(f);
                              for (
                                  let t = i["target"];
                                  t && t !== this;
                                  t = t.parentNode
                              )
                                  for (let e = o.length; e--; )
                                      if (o[e] === t)
                                          return (
                                              (i.delegateTarget = t),
                                              n.oneOff &&
                                                  v.off(d, i.type, f, p),
                                              p.apply(t, [i])
                                          );
                              return null;
                          })
                        : ((a = e),
                          (h = n),
                          function e(t) {
                              return (
                                  (t.delegateTarget = a),
                                  e.oneOff && v.off(a, t.type, h),
                                  h.apply(a, [t])
                              );
                          });
                    (c.delegationSelector = o ? n : null),
                        (c.originalHandler = r),
                        (c.oneOff = u),
                        (c.uidEvent = t),
                        (m[t] = c),
                        e.addEventListener(s, c, o);
                }
            }
        }
        function z(e, t, n, i, o) {
            i = B(t[n], i, o);
            i &&
                (e.removeEventListener(n, i, Boolean(o)),
                delete t[n][i.uidEvent]);
        }
        function $(e) {
            return (e = e.replace(N, "")), P[e] || e;
        }
        const v = {
                on(e, t, n, i) {
                    F(e, t, n, i, !1);
                },
                one(e, t, n, i) {
                    F(e, t, n, i, !0);
                },
                off(s, a, e, t) {
                    if ("string" == typeof a && s) {
                        const [n, i, o] = W(a, e, t),
                            r = o !== a,
                            l = R(s);
                        t = a.startsWith(".");
                        if (void 0 !== i)
                            return l && l[o]
                                ? void z(s, l, o, i, n ? e : null)
                                : void 0;
                        t &&
                            Object.keys(l).forEach((e) => {
                                {
                                    var t = s,
                                        n = l,
                                        i = e,
                                        o = a.slice(1);
                                    const r = n[i] || {};
                                    return void Object.keys(r).forEach((e) => {
                                        e.includes(o) &&
                                            ((e = r[e]),
                                            z(
                                                t,
                                                n,
                                                i,
                                                e.originalHandler,
                                                e.delegationSelector
                                            ));
                                    });
                                }
                            });
                        const c = l[o] || {};
                        Object.keys(c).forEach((e) => {
                            var t = e.replace(O, "");
                            (r && !a.includes(t)) ||
                                ((t = c[e]),
                                z(
                                    s,
                                    l,
                                    o,
                                    t.originalHandler,
                                    t.delegationSelector
                                ));
                        });
                    }
                },
                trigger(e, t, n) {
                    if ("string" != typeof t || !e) return null;
                    const i = _();
                    var o = $(t),
                        u = t !== o,
                        h = M.has(o);
                    let r,
                        s = !0,
                        a = !0,
                        l = !1,
                        c = null;
                    return (
                        u &&
                            i &&
                            ((r = i.Event(t, n)),
                            i(e).trigger(r),
                            (s = !r.isPropagationStopped()),
                            (a = !r.isImmediatePropagationStopped()),
                            (l = r.isDefaultPrevented())),
                        h
                            ? (c =
                                  document.createEvent("HTMLEvents")).initEvent(
                                  o,
                                  s,
                                  !0
                              )
                            : (c = new CustomEvent(t, {
                                  bubbles: s,
                                  cancelable: !0,
                              })),
                        void 0 !== n &&
                            Object.keys(n).forEach((e) => {
                                Object.defineProperty(c, e, {
                                    get() {
                                        return n[e];
                                    },
                                });
                            }),
                        l && c.preventDefault(),
                        a && e.dispatchEvent(c),
                        c.defaultPrevented &&
                            void 0 !== r &&
                            r.preventDefault(),
                        c
                    );
                },
            },
            U = new Map(),
            X = {
                set(e, t, n) {
                    U.has(e) || U.set(e, new Map());
                    const i = U.get(e);
                    i.has(t) || 0 === i.size
                        ? i.set(t, n)
                        : console.error(
                              `Bootstrap doesn't allow more than one instance per element. Bound instance: ${
                                  Array.from(i.keys())[0]
                              }.`
                          );
                },
                get(e, t) {
                    return (U.has(e) && U.get(e).get(t)) || null;
                },
                remove(e, t) {
                    if (U.has(e)) {
                        const n = U.get(e);
                        n.delete(t), 0 === n.size && U.delete(e);
                    }
                },
            };
        class V {
            constructor(e) {
                (e = o(e)) &&
                    ((this._element = e),
                    X.set(this._element, this.constructor.DATA_KEY, this));
            }
            dispose() {
                X.remove(this._element, this.constructor.DATA_KEY),
                    v.off(this._element, this.constructor.EVENT_KEY),
                    Object.getOwnPropertyNames(this).forEach((e) => {
                        this[e] = null;
                    });
            }
            _queueCallback(e, t, n = !0) {
                T(e, t, n);
            }
            static getInstance(e) {
                return X.get(o(e), this.DATA_KEY);
            }
            static getOrCreateInstance(e, t = {}) {
                return (
                    this.getInstance(e) ||
                    new this(e, "object" == typeof t ? t : null)
                );
            }
            static get VERSION() {
                return "5.1.3";
            }
            static get NAME() {
                throw new Error(
                    'You have to implement the static method "NAME", for each component!'
                );
            }
            static get DATA_KEY() {
                return "bs." + this.NAME;
            }
            static get EVENT_KEY() {
                return "." + this.DATA_KEY;
            }
        }
        var Y = (n, i = "hide") => {
            var e = "click.dismiss" + n.EVENT_KEY;
            const o = n.NAME;
            v.on(document, e, `[data-bs-dismiss="${o}"]`, function (e) {
                if (
                    (["A", "AREA"].includes(this.tagName) && e.preventDefault(),
                    !g(this))
                ) {
                    e = c(this) || this.closest("." + o);
                    const t = n.getOrCreateInstance(e);
                    t[i]();
                }
            });
        };
        class Q extends V {
            static get NAME() {
                return "alert";
            }
            close() {
                var e;
                v.trigger(this._element, "close.bs.alert").defaultPrevented ||
                    (this._element.classList.remove("show"),
                    (e = this._element.classList.contains("fade")),
                    this._queueCallback(
                        () => this._destroyElement(),
                        this._element,
                        e
                    ));
            }
            _destroyElement() {
                this._element.remove(),
                    v.trigger(this._element, "closed.bs.alert"),
                    this.dispose();
            }
            static jQueryInterface(t) {
                return this.each(function () {
                    const e = Q.getOrCreateInstance(this);
                    if ("string" == typeof t) {
                        if (
                            void 0 === e[t] ||
                            t.startsWith("_") ||
                            "constructor" === t
                        )
                            throw new TypeError(`No method named "${t}"`);
                        e[t](this);
                    }
                });
            }
        }
        Y(Q, "close"), x(Q);
        const G = '[data-bs-toggle="button"]';
        class K extends V {
            static get NAME() {
                return "button";
            }
            toggle() {
                this._element.setAttribute(
                    "aria-pressed",
                    this._element.classList.toggle("active")
                );
            }
            static jQueryInterface(t) {
                return this.each(function () {
                    const e = K.getOrCreateInstance(this);
                    "toggle" === t && e[t]();
                });
            }
        }
        function J(e) {
            return (
                "true" === e ||
                ("false" !== e &&
                    (e === Number(e).toString()
                        ? Number(e)
                        : "" === e || "null" === e
                        ? null
                        : e))
            );
        }
        function Z(e) {
            return e.replace(/[A-Z]/g, (e) => "-" + e.toLowerCase());
        }
        v.on(document, "click.bs.button.data-api", G, (e) => {
            e.preventDefault();
            e = e.target.closest(G);
            const t = K.getOrCreateInstance(e);
            t.toggle();
        }),
            x(K);
        const r = {
                setDataAttribute(e, t, n) {
                    e.setAttribute("data-bs-" + Z(t), n);
                },
                removeDataAttribute(e, t) {
                    e.removeAttribute("data-bs-" + Z(t));
                },
                getDataAttributes(n) {
                    if (!n) return {};
                    const i = {};
                    return (
                        Object.keys(n.dataset)
                            .filter((e) => e.startsWith("bs"))
                            .forEach((e) => {
                                let t = e.replace(/^bs/, "");
                                (t =
                                    t.charAt(0).toLowerCase() +
                                    t.slice(1, t.length)),
                                    (i[t] = J(n.dataset[e]));
                            }),
                        i
                    );
                },
                getDataAttribute(e, t) {
                    return J(e.getAttribute("data-bs-" + Z(t)));
                },
                offset(e) {
                    e = e.getBoundingClientRect();
                    return {
                        top: e.top + window.pageYOffset,
                        left: e.left + window.pageXOffset,
                    };
                },
                position(e) {
                    return { top: e.offsetTop, left: e.offsetLeft };
                },
            },
            h = {
                find(e, t = document.documentElement) {
                    return [].concat(
                        ...Element.prototype.querySelectorAll.call(t, e)
                    );
                },
                findOne(e, t = document.documentElement) {
                    return Element.prototype.querySelector.call(t, e);
                },
                children(e, t) {
                    return [].concat(...e.children).filter((e) => e.matches(t));
                },
                parents(e, t) {
                    const n = [];
                    let i = e.parentNode;
                    for (
                        ;
                        i &&
                        i.nodeType === Node.ELEMENT_NODE &&
                        3 !== i.nodeType;

                    )
                        i.matches(t) && n.push(i), (i = i.parentNode);
                    return n;
                },
                prev(e, t) {
                    let n = e.previousElementSibling;
                    for (; n; ) {
                        if (n.matches(t)) return [n];
                        n = n.previousElementSibling;
                    }
                    return [];
                },
                next(e, t) {
                    let n = e.nextElementSibling;
                    for (; n; ) {
                        if (n.matches(t)) return [n];
                        n = n.nextElementSibling;
                    }
                    return [];
                },
                focusableChildren(e) {
                    var t = [
                        "a",
                        "button",
                        "input",
                        "textarea",
                        "select",
                        "details",
                        "[tabindex]",
                        '[contenteditable="true"]',
                    ]
                        .map((e) => e + ':not([tabindex^="-"])')
                        .join(", ");
                    return this.find(t, e).filter((e) => !g(e) && p(e));
                },
            },
            ee = "carousel";
        var te = ".bs.carousel";
        const ne = {
                interval: 5e3,
                keyboard: !0,
                slide: !1,
                pause: "hover",
                wrap: !0,
                touch: !0,
            },
            ie = {
                interval: "(number|boolean)",
                keyboard: "boolean",
                slide: "(boolean|string)",
                pause: "(string|boolean)",
                wrap: "boolean",
                touch: "boolean",
            },
            oe = "next",
            re = "prev",
            se = "left",
            ae = "right",
            le = { ArrowLeft: ae, ArrowRight: se },
            ce = "slid" + te;
        const ue = "active",
            he = ".active.carousel-item";
        class de extends V {
            constructor(e, t) {
                super(e),
                    (this._items = null),
                    (this._interval = null),
                    (this._activeElement = null),
                    (this._isPaused = !1),
                    (this._isSliding = !1),
                    (this.touchTimeout = null),
                    (this.touchStartX = 0),
                    (this.touchDeltaX = 0),
                    (this._config = this._getConfig(t)),
                    (this._indicatorsElement = h.findOne(
                        ".carousel-indicators",
                        this._element
                    )),
                    (this._touchSupported =
                        "ontouchstart" in document.documentElement ||
                        0 < navigator.maxTouchPoints),
                    (this._pointerEvent = Boolean(window.PointerEvent)),
                    this._addEventListeners();
            }
            static get Default() {
                return ne;
            }
            static get NAME() {
                return ee;
            }
            next() {
                this._slide(oe);
            }
            nextWhenVisible() {
                !document.hidden && p(this._element) && this.next();
            }
            prev() {
                this._slide(re);
            }
            pause(e) {
                e || (this._isPaused = !0),
                    h.findOne(
                        ".carousel-item-next, .carousel-item-prev",
                        this._element
                    ) && (u(this._element), this.cycle(!0)),
                    clearInterval(this._interval),
                    (this._interval = null);
            }
            cycle(e) {
                e || (this._isPaused = !1),
                    this._interval &&
                        (clearInterval(this._interval),
                        (this._interval = null)),
                    this._config &&
                        this._config.interval &&
                        !this._isPaused &&
                        (this._updateInterval(),
                        (this._interval = setInterval(
                            (document.visibilityState
                                ? this.nextWhenVisible
                                : this.next
                            ).bind(this),
                            this._config.interval
                        )));
            }
            to(e) {
                this._activeElement = h.findOne(he, this._element);
                var t = this._getItemIndex(this._activeElement);
                if (!(e > this._items.length - 1 || e < 0))
                    if (this._isSliding)
                        v.one(this._element, ce, () => this.to(e));
                    else {
                        if (t === e) return this.pause(), void this.cycle();
                        t = t < e ? oe : re;
                        this._slide(t, this._items[e]);
                    }
            }
            _getConfig(e) {
                return (
                    (e = {
                        ...ne,
                        ...r.getDataAttributes(this._element),
                        ...("object" == typeof e ? e : {}),
                    }),
                    f(ee, e, ie),
                    e
                );
            }
            _handleSwipe() {
                var e = Math.abs(this.touchDeltaX);
                e <= 40 ||
                    ((e = e / this.touchDeltaX),
                    (this.touchDeltaX = 0),
                    e && this._slide(0 < e ? ae : se));
            }
            _addEventListeners() {
                this._config.keyboard &&
                    v.on(this._element, "keydown.bs.carousel", (e) =>
                        this._keydown(e)
                    ),
                    "hover" === this._config.pause &&
                        (v.on(this._element, "mouseenter.bs.carousel", (e) =>
                            this.pause(e)
                        ),
                        v.on(this._element, "mouseleave.bs.carousel", (e) =>
                            this.cycle(e)
                        )),
                    this._config.touch &&
                        this._touchSupported &&
                        this._addTouchEventListeners();
            }
            _addTouchEventListeners() {
                const t = (e) =>
                        this._pointerEvent &&
                        ("pen" === e.pointerType || "touch" === e.pointerType),
                    n = (e) => {
                        t(e)
                            ? (this.touchStartX = e.clientX)
                            : this._pointerEvent ||
                              (this.touchStartX = e.touches[0].clientX);
                    },
                    i = (e) => {
                        this.touchDeltaX =
                            e.touches && 1 < e.touches.length
                                ? 0
                                : e.touches[0].clientX - this.touchStartX;
                    },
                    o = (e) => {
                        t(e) &&
                            (this.touchDeltaX = e.clientX - this.touchStartX),
                            this._handleSwipe(),
                            "hover" === this._config.pause &&
                                (this.pause(),
                                this.touchTimeout &&
                                    clearTimeout(this.touchTimeout),
                                (this.touchTimeout = setTimeout(
                                    (e) => this.cycle(e),
                                    500 + this._config.interval
                                )));
                    };
                h.find(".carousel-item img", this._element).forEach((e) => {
                    v.on(e, "dragstart.bs.carousel", (e) => e.preventDefault());
                }),
                    this._pointerEvent
                        ? (v.on(this._element, "pointerdown.bs.carousel", (e) =>
                              n(e)
                          ),
                          v.on(this._element, "pointerup.bs.carousel", (e) =>
                              o(e)
                          ),
                          this._element.classList.add("pointer-event"))
                        : (v.on(this._element, "touchstart.bs.carousel", (e) =>
                              n(e)
                          ),
                          v.on(this._element, "touchmove.bs.carousel", (e) =>
                              i(e)
                          ),
                          v.on(this._element, "touchend.bs.carousel", (e) =>
                              o(e)
                          ));
            }
            _keydown(e) {
                var t;
                /input|textarea/i.test(e.target.tagName) ||
                    ((t = le[e.key]) && (e.preventDefault(), this._slide(t)));
            }
            _getItemIndex(e) {
                return (
                    (this._items =
                        e && e.parentNode
                            ? h.find(".carousel-item", e.parentNode)
                            : []),
                    this._items.indexOf(e)
                );
            }
            _getItemByOrder(e, t) {
                e = e === oe;
                return k(this._items, t, e, this._config.wrap);
            }
            _triggerSlideEvent(e, t) {
                var n = this._getItemIndex(e),
                    i = this._getItemIndex(h.findOne(he, this._element));
                return v.trigger(this._element, "slide.bs.carousel", {
                    relatedTarget: e,
                    direction: t,
                    from: i,
                    to: n,
                });
            }
            _setActiveIndicatorElement(t) {
                if (this._indicatorsElement) {
                    const e = h.findOne(".active", this._indicatorsElement),
                        n =
                            (e.classList.remove(ue),
                            e.removeAttribute("aria-current"),
                            h.find(
                                "[data-bs-target]",
                                this._indicatorsElement
                            ));
                    for (let e = 0; e < n.length; e++)
                        if (
                            Number.parseInt(
                                n[e].getAttribute("data-bs-slide-to"),
                                10
                            ) === this._getItemIndex(t)
                        ) {
                            n[e].classList.add(ue),
                                n[e].setAttribute("aria-current", "true");
                            break;
                        }
                }
            }
            _updateInterval() {
                const e = this._activeElement || h.findOne(he, this._element);
                var t;
                e &&
                    ((t = Number.parseInt(
                        e.getAttribute("data-bs-interval"),
                        10
                    ))
                        ? ((this._config.defaultInterval =
                              this._config.defaultInterval ||
                              this._config.interval),
                          (this._config.interval = t))
                        : (this._config.interval =
                              this._config.defaultInterval ||
                              this._config.interval));
            }
            _slide(e, t) {
                e = this._directionToOrder(e);
                const n = h.findOne(he, this._element),
                    i = this._getItemIndex(n),
                    o = t || this._getItemByOrder(e, n),
                    u = this._getItemIndex(o);
                var t = Boolean(this._interval),
                    r = e === oe;
                const s = r ? "carousel-item-start" : "carousel-item-end",
                    a = r ? "carousel-item-next" : "carousel-item-prev",
                    l = this._orderToDirection(e);
                if (o && o.classList.contains(ue)) this._isSliding = !1;
                else if (!this._isSliding) {
                    r = this._triggerSlideEvent(o, l);
                    if (!r.defaultPrevented && n && o) {
                        (this._isSliding = !0),
                            t && this.pause(),
                            this._setActiveIndicatorElement(o),
                            (this._activeElement = o);
                        const c = () => {
                            v.trigger(this._element, ce, {
                                relatedTarget: o,
                                direction: l,
                                from: i,
                                to: u,
                            });
                        };
                        this._element.classList.contains("slide")
                            ? (o.classList.add(a),
                              b(o),
                              n.classList.add(s),
                              o.classList.add(s),
                              this._queueCallback(
                                  () => {
                                      o.classList.remove(s, a),
                                          o.classList.add(ue),
                                          n.classList.remove(ue, a, s),
                                          (this._isSliding = !1),
                                          setTimeout(c, 0);
                                  },
                                  n,
                                  !0
                              ))
                            : (n.classList.remove(ue),
                              o.classList.add(ue),
                              (this._isSliding = !1),
                              c()),
                            t && this.cycle();
                    }
                }
            }
            _directionToOrder(e) {
                return [ae, se].includes(e)
                    ? i()
                        ? e === se
                            ? re
                            : oe
                        : e === se
                        ? oe
                        : re
                    : e;
            }
            _orderToDirection(e) {
                return [oe, re].includes(e)
                    ? i()
                        ? e === re
                            ? se
                            : ae
                        : e === re
                        ? ae
                        : se
                    : e;
            }
            static carouselInterface(e, t) {
                const n = de.getOrCreateInstance(e, t);
                let i = n["_config"];
                "object" == typeof t && (i = { ...i, ...t });
                e = "string" == typeof t ? t : i.slide;
                if ("number" == typeof t) n.to(t);
                else if ("string" == typeof e) {
                    if (void 0 === n[e])
                        throw new TypeError(`No method named "${e}"`);
                    n[e]();
                } else i.interval && i.ride && (n.pause(), n.cycle());
            }
            static jQueryInterface(e) {
                return this.each(function () {
                    de.carouselInterface(this, e);
                });
            }
            static dataApiClickHandler(e) {
                const t = c(this);
                if (t && t.classList.contains("carousel")) {
                    const i = {
                        ...r.getDataAttributes(t),
                        ...r.getDataAttributes(this),
                    };
                    var n = this.getAttribute("data-bs-slide-to");
                    n && (i.interval = !1),
                        de.carouselInterface(t, i),
                        n && de.getInstance(t).to(n),
                        e.preventDefault();
                }
            }
        }
        v.on(
            document,
            "click.bs.carousel.data-api",
            "[data-bs-slide], [data-bs-slide-to]",
            de.dataApiClickHandler
        ),
            v.on(window, "load.bs.carousel.data-api", () => {
                var n = h.find('[data-bs-ride="carousel"]');
                for (let e = 0, t = n.length; e < t; e++)
                    de.carouselInterface(n[e], de.getInstance(n[e]));
            }),
            x(de);
        const fe = "collapse",
            pe = "bs.collapse";
        pe;
        const ge = { toggle: !0, parent: null },
            me = { toggle: "boolean", parent: "(null|element)" };
        const ve = "show",
            ye = "collapse",
            be = "collapsing",
            _e = "collapsed",
            we = `:scope .${ye} .` + ye,
            xe = '[data-bs-toggle="collapse"]';
        class Ee extends V {
            constructor(e, t) {
                super(e),
                    (this._isTransitioning = !1),
                    (this._config = this._getConfig(t)),
                    (this._triggerArray = []);
                var n = h.find(xe);
                for (let e = 0, t = n.length; e < t; e++) {
                    var i = n[e],
                        o = l(i),
                        r = h.find(o).filter((e) => e === this._element);
                    null !== o &&
                        r.length &&
                        ((this._selector = o), this._triggerArray.push(i));
                }
                this._initializeChildren(),
                    this._config.parent ||
                        this._addAriaAndCollapsedClass(
                            this._triggerArray,
                            this._isShown()
                        ),
                    this._config.toggle && this.toggle();
            }
            static get Default() {
                return ge;
            }
            static get NAME() {
                return fe;
            }
            toggle() {
                this._isShown() ? this.hide() : this.show();
            }
            show() {
                if (!this._isTransitioning && !this._isShown()) {
                    let e = [],
                        t;
                    if (this._config.parent) {
                        const o = h.find(we, this._config.parent);
                        e = h
                            .find(
                                ".collapse.show, .collapse.collapsing",
                                this._config.parent
                            )
                            .filter((e) => !o.includes(e));
                    }
                    const i = h.findOne(this._selector);
                    if (e.length) {
                        var n = e.find((e) => i !== e);
                        if (
                            (t = n ? Ee.getInstance(n) : null) &&
                            t._isTransitioning
                        )
                            return;
                    }
                    if (
                        !v.trigger(this._element, "show.bs.collapse")
                            .defaultPrevented
                    ) {
                        e.forEach((e) => {
                            i !== e &&
                                Ee.getOrCreateInstance(e, {
                                    toggle: !1,
                                }).hide(),
                                t || X.set(e, pe, null);
                        });
                        const r = this._getDimension();
                        this._element.classList.remove(ye),
                            this._element.classList.add(be),
                            (this._element.style[r] = 0),
                            this._addAriaAndCollapsedClass(
                                this._triggerArray,
                                !0
                            ),
                            (this._isTransitioning = !0);
                        n = "scroll" + (r[0].toUpperCase() + r.slice(1));
                        this._queueCallback(
                            () => {
                                (this._isTransitioning = !1),
                                    this._element.classList.remove(be),
                                    this._element.classList.add(ye, ve),
                                    (this._element.style[r] = ""),
                                    v.trigger(
                                        this._element,
                                        "shown.bs.collapse"
                                    );
                            },
                            this._element,
                            !0
                        ),
                            (this._element.style[r] = this._element[n] + "px");
                    }
                }
            }
            hide() {
                if (
                    !this._isTransitioning &&
                    this._isShown() &&
                    !v.trigger(this._element, "hide.bs.collapse")
                        .defaultPrevented
                ) {
                    var e = this._getDimension(),
                        t =
                            ((this._element.style[e] =
                                this._element.getBoundingClientRect()[e] +
                                "px"),
                            b(this._element),
                            this._element.classList.add(be),
                            this._element.classList.remove(ye, ve),
                            this._triggerArray.length);
                    for (let e = 0; e < t; e++) {
                        var n = this._triggerArray[e],
                            i = c(n);
                        i &&
                            !this._isShown(i) &&
                            this._addAriaAndCollapsedClass([n], !1);
                    }
                    this._isTransitioning = !0;
                    (this._element.style[e] = ""),
                        this._queueCallback(
                            () => {
                                (this._isTransitioning = !1),
                                    this._element.classList.remove(be),
                                    this._element.classList.add(ye),
                                    v.trigger(
                                        this._element,
                                        "hidden.bs.collapse"
                                    );
                            },
                            this._element,
                            !0
                        );
                }
            }
            _isShown(e = this._element) {
                return e.classList.contains(ve);
            }
            _getConfig(e) {
                return (
                    ((e = {
                        ...ge,
                        ...r.getDataAttributes(this._element),
                        ...e,
                    }).toggle = Boolean(e.toggle)),
                    (e.parent = o(e.parent)),
                    f(fe, e, me),
                    e
                );
            }
            _getDimension() {
                return this._element.classList.contains("collapse-horizontal")
                    ? "width"
                    : "height";
            }
            _initializeChildren() {
                if (this._config.parent) {
                    const t = h.find(we, this._config.parent);
                    h.find(xe, this._config.parent)
                        .filter((e) => !t.includes(e))
                        .forEach((e) => {
                            var t = c(e);
                            t &&
                                this._addAriaAndCollapsedClass(
                                    [e],
                                    this._isShown(t)
                                );
                        });
                }
            }
            _addAriaAndCollapsedClass(e, t) {
                e.length &&
                    e.forEach((e) => {
                        t ? e.classList.remove(_e) : e.classList.add(_e),
                            e.setAttribute("aria-expanded", t);
                    });
            }
            static jQueryInterface(n) {
                return this.each(function () {
                    const e = {},
                        t =
                            ("string" == typeof n &&
                                /show|hide/.test(n) &&
                                (e.toggle = !1),
                            Ee.getOrCreateInstance(this, e));
                    if ("string" == typeof n) {
                        if (void 0 === t[n])
                            throw new TypeError(`No method named "${n}"`);
                        t[n]();
                    }
                });
            }
        }
        v.on(document, "click.bs.collapse.data-api", xe, function (e) {
            ("A" === e.target.tagName ||
                (e.delegateTarget && "A" === e.delegateTarget.tagName)) &&
                e.preventDefault();
            e = l(this);
            const t = h.find(e);
            t.forEach((e) => {
                Ee.getOrCreateInstance(e, { toggle: !1 }).toggle();
            });
        }),
            x(Ee);
        var A = "top",
            S = "bottom",
            L = "right",
            D = "left",
            Te = "auto",
            ke = [A, S, L, D],
            Ce = "start",
            Ae = "end",
            Se = "clippingParents",
            Le = "viewport",
            De = "popper",
            Ne = "reference",
            Oe = ke.reduce(function (e, t) {
                return e.concat([t + "-" + Ce, t + "-" + Ae]);
            }, []),
            je = [].concat(ke, [Te]).reduce(function (e, t) {
                return e.concat([t, t + "-" + Ce, t + "-" + Ae]);
            }, []),
            te = "beforeRead",
            Ie = "afterRead",
            Pe = "beforeMain",
            He = "afterMain",
            Me = "beforeWrite",
            qe = "afterWrite",
            Re = [te, "read", Ie, Pe, "main", He, Me, "write", qe];
        function Be(e) {
            return e ? (e.nodeName || "").toLowerCase() : null;
        }
        function We(e) {
            return null == e
                ? window
                : "[object Window]" !== e.toString()
                ? ((t = e.ownerDocument) && t.defaultView) || window
                : e;
            var t;
        }
        function Fe(e) {
            return e instanceof We(e).Element || e instanceof Element;
        }
        function ze(e) {
            return e instanceof We(e).HTMLElement || e instanceof HTMLElement;
        }
        function $e(e) {
            return (
                "undefined" != typeof ShadowRoot &&
                (e instanceof We(e).ShadowRoot || e instanceof ShadowRoot)
            );
        }
        var e = {
            name: "applyStyles",
            enabled: !0,
            phase: "write",
            fn: function (e) {
                var o = e.state;
                Object.keys(o.elements).forEach(function (e) {
                    var t = o.styles[e] || {},
                        n = o.attributes[e] || {},
                        i = o.elements[e];
                    ze(i) &&
                        Be(i) &&
                        (Object.assign(i.style, t),
                        Object.keys(n).forEach(function (e) {
                            var t = n[e];
                            !1 === t
                                ? i.removeAttribute(e)
                                : i.setAttribute(e, !0 === t ? "" : t);
                        }));
                });
            },
            effect: function (e) {
                var i = e.state,
                    o = {
                        popper: {
                            position: i.options.strategy,
                            left: "0",
                            top: "0",
                            margin: "0",
                        },
                        arrow: { position: "absolute" },
                        reference: {},
                    };
                return (
                    Object.assign(i.elements.popper.style, o.popper),
                    (i.styles = o),
                    i.elements.arrow &&
                        Object.assign(i.elements.arrow.style, o.arrow),
                    function () {
                        Object.keys(i.elements).forEach(function (e) {
                            var t = i.elements[e],
                                n = i.attributes[e] || {},
                                e = Object.keys(
                                    (i.styles.hasOwnProperty(e) ? i.styles : o)[
                                        e
                                    ]
                                ).reduce(function (e, t) {
                                    return (e[t] = ""), e;
                                }, {});
                            ze(t) &&
                                Be(t) &&
                                (Object.assign(t.style, e),
                                Object.keys(n).forEach(function (e) {
                                    t.removeAttribute(e);
                                }));
                        });
                    }
                );
            },
            requires: ["computeStyles"],
        };
        function Ue(e) {
            return e.split("-")[0];
        }
        function Xe(e) {
            e = e.getBoundingClientRect();
            return {
                width: +e.width,
                height: +e.height,
                top: +e.top,
                right: +e.right,
                bottom: +e.bottom,
                left: +e.left,
                x: +e.left,
                y: +e.top,
            };
        }
        function Ve(e) {
            var t = Xe(e),
                n = e.offsetWidth,
                i = e.offsetHeight;
            return (
                Math.abs(t.width - n) <= 1 && (n = t.width),
                Math.abs(t.height - i) <= 1 && (i = t.height),
                { x: e.offsetLeft, y: e.offsetTop, width: n, height: i }
            );
        }
        function Ye(e, t) {
            var n = t.getRootNode && t.getRootNode();
            if (e.contains(t)) return !0;
            if (n && $e(n)) {
                var i = t;
                do {
                    if (i && e.isSameNode(i)) return !0;
                } while ((i = i.parentNode || i.host));
            }
            return !1;
        }
        function Qe(e) {
            return We(e).getComputedStyle(e);
        }
        function Ge(e) {
            return (
                (Fe(e) ? e.ownerDocument : e.document) || window.document
            ).documentElement;
        }
        function Ke(e) {
            return "html" === Be(e)
                ? e
                : e.assignedSlot ||
                      e.parentNode ||
                      ($e(e) ? e.host : null) ||
                      Ge(e);
        }
        function Je(e) {
            return ze(e) && "fixed" !== Qe(e).position ? e.offsetParent : null;
        }
        function Ze(e) {
            for (
                var t, n = We(e), i = Je(e);
                i &&
                ((t = i), 0 <= ["table", "td", "th"].indexOf(Be(t))) &&
                "static" === Qe(i).position;

            )
                i = Je(i);
            return (
                ((!i ||
                    ("html" !== Be(i) &&
                        ("body" !== Be(i) || "static" !== Qe(i).position))) &&
                    (i ||
                        (function (e) {
                            var t =
                                    -1 !==
                                    navigator.userAgent
                                        .toLowerCase()
                                        .indexOf("firefox"),
                                n =
                                    -1 !==
                                    navigator.userAgent.indexOf("Trident");
                            if (n && ze(e) && "fixed" === Qe(e).position)
                                return null;
                            for (
                                var i = Ke(e);
                                ze(i) && ["html", "body"].indexOf(Be(i)) < 0;

                            ) {
                                var o = Qe(i);
                                if (
                                    "none" !== o.transform ||
                                    "none" !== o.perspective ||
                                    "paint" === o.contain ||
                                    -1 !==
                                        ["transform", "perspective"].indexOf(
                                            o.willChange
                                        ) ||
                                    (t && "filter" === o.willChange) ||
                                    (t && o.filter && "none" !== o.filter)
                                )
                                    return i;
                                i = i.parentNode;
                            }
                            return null;
                        })(e))) ||
                n
            );
        }
        function et(e) {
            return 0 <= ["top", "bottom"].indexOf(e) ? "x" : "y";
        }
        var tt = Math.max,
            nt = Math.min,
            it = Math.round;
        function ot(e, t, n) {
            return tt(e, nt(t, n));
        }
        function rt() {
            return { top: 0, right: 0, bottom: 0, left: 0 };
        }
        function st(e) {
            return Object.assign({}, rt(), e);
        }
        function at(n, e) {
            return e.reduce(function (e, t) {
                return (e[t] = n), e;
            }, {});
        }
        var t = {
            name: "arrow",
            enabled: !0,
            phase: "main",
            fn: function (e) {
                var t,
                    n,
                    i,
                    o,
                    r = e.state,
                    u = e.name,
                    e = e.options,
                    s = r.elements.arrow,
                    a = r.modifiersData.popperOffsets,
                    l = et((c = Ue(r.placement))),
                    c = 0 <= [D, L].indexOf(c) ? "height" : "width";
                s &&
                    a &&
                    ((e = e.padding),
                    (n = r),
                    (n = st(
                        "number" !=
                            typeof (e =
                                "function" == typeof e
                                    ? e(
                                          Object.assign({}, n.rects, {
                                              placement: n.placement,
                                          })
                                      )
                                    : e)
                            ? e
                            : at(e, ke)
                    )),
                    (e = Ve(s)),
                    (o = "y" === l ? A : D),
                    (i = "y" === l ? S : L),
                    (t =
                        r.rects.reference[c] +
                        r.rects.reference[l] -
                        a[l] -
                        r.rects.popper[c]),
                    (a = a[l] - r.rects.reference[l]),
                    (s = (s = Ze(s))
                        ? "y" === l
                            ? s.clientHeight || 0
                            : s.clientWidth || 0
                        : 0),
                    (o = n[o]),
                    (n = s - e[c] - n[i]),
                    (o = ot(o, (i = s / 2 - e[c] / 2 + (t / 2 - a / 2)), n)),
                    (r.modifiersData[u] =
                        (((s = {})[l] = o), (s.centerOffset = o - i), s)));
            },
            effect: function (e) {
                var t = e.state;
                null !=
                    (e =
                        void 0 === (e = e.options.element)
                            ? "[data-popper-arrow]"
                            : e) &&
                    ("string" != typeof e ||
                        (e = t.elements.popper.querySelector(e))) &&
                    Ye(t.elements.popper, e) &&
                    (t.elements.arrow = e);
            },
            requires: ["popperOffsets"],
            requiresIfExists: ["preventOverflow"],
        };
        function lt(e) {
            return e.split("-")[1];
        }
        var ct = { top: "auto", right: "auto", bottom: "auto", left: "auto" };
        function ut(e) {
            var t,
                n,
                i,
                o = e.popper,
                u = e.popperRect,
                r = e.placement,
                h = e.variation,
                s = e.offsets,
                d = e.position,
                f = e.gpuAcceleration,
                p = e.adaptive,
                e = e.roundOffsets,
                a =
                    !0 === e
                        ? ((a = (l = s).x),
                          (l = s.y),
                          (c = window.devicePixelRatio || 1),
                          {
                              x: it(it(a * c) / c) || 0,
                              y: it(it(l * c) / c) || 0,
                          })
                        : "function" == typeof e
                        ? e(s)
                        : s,
                l = a.x,
                c = void 0 === l ? 0 : l,
                e = a.y,
                e = void 0 === e ? 0 : e,
                g = s.hasOwnProperty("x"),
                s = s.hasOwnProperty("y"),
                m = D,
                v = A,
                y = window,
                o =
                    (p &&
                        ((i = "clientHeight"),
                        (n = "clientWidth"),
                        (t = Ze(o)) === We(o) &&
                            "static" !== Qe((t = Ge(o))).position &&
                            "absolute" === d &&
                            ((i = "scrollHeight"), (n = "scrollWidth")),
                        (r !== A && ((r !== D && r !== L) || h !== Ae)) ||
                            ((v = S),
                            (e = (e - (t[i] - u.height)) * (f ? 1 : -1))),
                        (r !== D && ((r !== A && r !== S) || h !== Ae)) ||
                            ((m = L),
                            (c = (c - (t[n] - u.width)) * (f ? 1 : -1)))),
                    Object.assign({ position: d }, p && ct));
            return f
                ? Object.assign(
                      {},
                      o,
                      (((i = {})[v] = s ? "0" : ""),
                      (i[m] = g ? "0" : ""),
                      (i.transform =
                          (y.devicePixelRatio || 1) <= 1
                              ? "translate(" + c + "px, " + e + "px)"
                              : "translate3d(" + c + "px, " + e + "px, 0)"),
                      i)
                  )
                : Object.assign(
                      {},
                      o,
                      (((r = {})[v] = s ? e + "px" : ""),
                      (r[m] = g ? c + "px" : ""),
                      (r.transform = ""),
                      r)
                  );
        }
        var ht = {
                name: "computeStyles",
                enabled: !0,
                phase: "beforeWrite",
                fn: function (e) {
                    var t = e.state,
                        e = e.options,
                        n = void 0 === (n = e.gpuAcceleration) || n,
                        i = void 0 === (i = e.adaptive) || i,
                        e = void 0 === (e = e.roundOffsets) || e,
                        n = {
                            placement: Ue(t.placement),
                            variation: lt(t.placement),
                            popper: t.elements.popper,
                            popperRect: t.rects.popper,
                            gpuAcceleration: n,
                        };
                    null != t.modifiersData.popperOffsets &&
                        (t.styles.popper = Object.assign(
                            {},
                            t.styles.popper,
                            ut(
                                Object.assign({}, n, {
                                    offsets: t.modifiersData.popperOffsets,
                                    position: t.options.strategy,
                                    adaptive: i,
                                    roundOffsets: e,
                                })
                            )
                        )),
                        null != t.modifiersData.arrow &&
                            (t.styles.arrow = Object.assign(
                                {},
                                t.styles.arrow,
                                ut(
                                    Object.assign({}, n, {
                                        offsets: t.modifiersData.arrow,
                                        position: "absolute",
                                        adaptive: !1,
                                        roundOffsets: e,
                                    })
                                )
                            )),
                        (t.attributes.popper = Object.assign(
                            {},
                            t.attributes.popper,
                            { "data-popper-placement": t.placement }
                        ));
                },
                data: {},
            },
            dt = { passive: !0 };
        var ft = {
                name: "eventListeners",
                enabled: !0,
                phase: "write",
                fn: function () {},
                effect: function (e) {
                    var t = e.state,
                        n = e.instance,
                        i = (e = e.options).scroll,
                        o = void 0 === i || i,
                        r = void 0 === (i = e.resize) || i,
                        s = We(t.elements.popper),
                        a = [].concat(
                            t.scrollParents.reference,
                            t.scrollParents.popper
                        );
                    return (
                        o &&
                            a.forEach(function (e) {
                                e.addEventListener("scroll", n.update, dt);
                            }),
                        r && s.addEventListener("resize", n.update, dt),
                        function () {
                            o &&
                                a.forEach(function (e) {
                                    e.removeEventListener(
                                        "scroll",
                                        n.update,
                                        dt
                                    );
                                }),
                                r &&
                                    s.removeEventListener(
                                        "resize",
                                        n.update,
                                        dt
                                    );
                        }
                    );
                },
                data: {},
            },
            pt = { left: "right", right: "left", bottom: "top", top: "bottom" };
        function gt(e) {
            return e.replace(/left|right|bottom|top/g, function (e) {
                return pt[e];
            });
        }
        var mt = { start: "end", end: "start" };
        function vt(e) {
            return e.replace(/start|end/g, function (e) {
                return mt[e];
            });
        }
        function yt(e) {
            e = We(e);
            return { scrollLeft: e.pageXOffset, scrollTop: e.pageYOffset };
        }
        function bt(e) {
            return Xe(Ge(e)).left + yt(e).scrollLeft;
        }
        function _t(e) {
            var e = Qe(e),
                t = e.overflow,
                n = e.overflowX,
                e = e.overflowY;
            return /auto|scroll|overlay|hidden/.test(t + e + n);
        }
        function wt(e, t) {
            void 0 === t && (t = []);
            var n = (function e(t) {
                    return 0 <= ["html", "body", "#document"].indexOf(Be(t))
                        ? t.ownerDocument.body
                        : ze(t) && _t(t)
                        ? t
                        : e(Ke(t));
                })(e),
                e = n === (null == (e = e.ownerDocument) ? void 0 : e.body),
                i = We(n),
                i = e ? [i].concat(i.visualViewport || [], _t(n) ? n : []) : n,
                n = t.concat(i);
            return e ? n : n.concat(wt(Ke(i)));
        }
        function xt(e) {
            return Object.assign({}, e, {
                left: e.x,
                top: e.y,
                right: e.x + e.width,
                bottom: e.y + e.height,
            });
        }
        function Et(e, t) {
            return t === Le
                ? xt(
                      ((i = We((n = e))),
                      (o = Ge(n)),
                      (i = i.visualViewport),
                      (r = o.clientWidth),
                      (o = o.clientHeight),
                      (a = s = 0),
                      i &&
                          ((r = i.width),
                          (o = i.height),
                          /^((?!chrome|android).)*safari/i.test(
                              navigator.userAgent
                          ) || ((s = i.offsetLeft), (a = i.offsetTop))),
                      { width: r, height: o, x: s + bt(n), y: a })
                  )
                : ze(t)
                ? (((r = Xe((i = t))).top = r.top + i.clientTop),
                  (r.left = r.left + i.clientLeft),
                  (r.bottom = r.top + i.clientHeight),
                  (r.right = r.left + i.clientWidth),
                  (r.width = i.clientWidth),
                  (r.height = i.clientHeight),
                  (r.x = r.left),
                  (r.y = r.top),
                  r)
                : xt(
                      ((o = Ge(e)),
                      (s = Ge(o)),
                      (n = yt(o)),
                      (a = null == (a = o.ownerDocument) ? void 0 : a.body),
                      (t = tt(
                          s.scrollWidth,
                          s.clientWidth,
                          a ? a.scrollWidth : 0,
                          a ? a.clientWidth : 0
                      )),
                      (e = tt(
                          s.scrollHeight,
                          s.clientHeight,
                          a ? a.scrollHeight : 0,
                          a ? a.clientHeight : 0
                      )),
                      (o = -n.scrollLeft + bt(o)),
                      (n = -n.scrollTop),
                      "rtl" === Qe(a || s).direction &&
                          (o += tt(s.clientWidth, a ? a.clientWidth : 0) - t),
                      { width: t, height: e, x: o, y: n })
                  );
            var n, i, o, r, s, a;
        }
        function Tt(n, e, t) {
            var i,
                o =
                    "clippingParents" === e
                        ? ((r = wt(Ke((o = n)))),
                          Fe(
                              (i =
                                  0 <=
                                      ["absolute", "fixed"].indexOf(
                                          Qe(o).position
                                      ) && ze(o)
                                      ? Ze(o)
                                      : o)
                          )
                              ? r.filter(function (e) {
                                    return (
                                        Fe(e) && Ye(e, i) && "body" !== Be(e)
                                    );
                                })
                              : [])
                        : [].concat(e),
                r = [].concat(o, [t]),
                e = r[0],
                t = r.reduce(function (e, t) {
                    t = Et(n, t);
                    return (
                        (e.top = tt(t.top, e.top)),
                        (e.right = nt(t.right, e.right)),
                        (e.bottom = nt(t.bottom, e.bottom)),
                        (e.left = tt(t.left, e.left)),
                        e
                    );
                }, Et(n, e));
            return (
                (t.width = t.right - t.left),
                (t.height = t.bottom - t.top),
                (t.x = t.left),
                (t.y = t.top),
                t
            );
        }
        function kt(e) {
            var t,
                n = e.reference,
                i = e.element,
                e = e.placement,
                o = e ? Ue(e) : null,
                e = e ? lt(e) : null,
                r = n.x + n.width / 2 - i.width / 2,
                s = n.y + n.height / 2 - i.height / 2;
            switch (o) {
                case A:
                    t = { x: r, y: n.y - i.height };
                    break;
                case S:
                    t = { x: r, y: n.y + n.height };
                    break;
                case L:
                    t = { x: n.x + n.width, y: s };
                    break;
                case D:
                    t = { x: n.x - i.width, y: s };
                    break;
                default:
                    t = { x: n.x, y: n.y };
            }
            var a = o ? et(o) : null;
            if (null != a) {
                var l = "y" === a ? "height" : "width";
                switch (e) {
                    case Ce:
                        t[a] = t[a] - (n[l] / 2 - i[l] / 2);
                        break;
                    case Ae:
                        t[a] = t[a] + (n[l] / 2 - i[l] / 2);
                }
            }
            return t;
        }
        function Ct(e, t) {
            var i,
                t = (t = void 0 === t ? {} : t),
                n = t.placement,
                n = void 0 === n ? e.placement : n,
                o = t.boundary,
                o = void 0 === o ? Se : o,
                r = t.rootBoundary,
                r = void 0 === r ? Le : r,
                s = t.elementContext,
                s = void 0 === s ? De : s,
                a = t.altBoundary,
                a = void 0 !== a && a,
                t = t.padding,
                t = void 0 === t ? 0 : t,
                t = st("number" != typeof t ? t : at(t, ke)),
                l = e.rects.popper,
                a = e.elements[a ? (s === De ? Ne : De) : s],
                a = Tt(
                    Fe(a) ? a : a.contextElement || Ge(e.elements.popper),
                    o,
                    r
                ),
                o = Xe(e.elements.reference),
                r = kt({
                    reference: o,
                    element: l,
                    strategy: "absolute",
                    placement: n,
                }),
                l = xt(Object.assign({}, l, r)),
                r = s === De ? l : o,
                c = {
                    top: a.top - r.top + t.top,
                    bottom: r.bottom - a.bottom + t.bottom,
                    left: a.left - r.left + t.left,
                    right: r.right - a.right + t.right,
                },
                l = e.modifiersData.offset;
            return (
                s === De &&
                    l &&
                    ((i = l[n]),
                    Object.keys(c).forEach(function (e) {
                        var t = 0 <= [L, S].indexOf(e) ? 1 : -1,
                            n = 0 <= [A, S].indexOf(e) ? "y" : "x";
                        c[e] += i[n] * t;
                    })),
                c
            );
        }
        var At = {
            name: "flip",
            enabled: !0,
            phase: "main",
            fn: function (e) {
                var h = e.state,
                    t = e.options,
                    e = e.name;
                if (!h.modifiersData[e]._skip) {
                    for (
                        var n = t.mainAxis,
                            c = void 0 === n || n,
                            n = t.altAxis,
                            u = void 0 === n || n,
                            n = t.fallbackPlacements,
                            d = t.padding,
                            f = t.boundary,
                            p = t.rootBoundary,
                            g = t.altBoundary,
                            i = t.flipVariations,
                            m = void 0 === i || i,
                            v = t.allowedAutoPlacements,
                            i = h.options.placement,
                            t = Ue(i),
                            n =
                                n ||
                                (t === i || !m
                                    ? [gt(i)]
                                    : (function (e) {
                                          if (Ue(e) === Te) return [];
                                          var t = gt(e);
                                          return [vt(e), t, vt(t)];
                                      })(i)),
                            o = [i].concat(n).reduce(function (e, t) {
                                return e.concat(
                                    Ue(t) === Te
                                        ? ((n = h),
                                          (i = (e = e =
                                              void 0 ===
                                              (e = {
                                                  placement: t,
                                                  boundary: f,
                                                  rootBoundary: p,
                                                  padding: d,
                                                  flipVariations: m,
                                                  allowedAutoPlacements: v,
                                              })
                                                  ? {}
                                                  : e).placement),
                                          (o = e.boundary),
                                          (r = e.rootBoundary),
                                          (s = e.padding),
                                          (a = e.flipVariations),
                                          (u =
                                              void 0 ===
                                              (e = e.allowedAutoPlacements)
                                                  ? je
                                                  : e),
                                          (l = lt(i)),
                                          (e = l
                                              ? a
                                                  ? Oe
                                                  : Oe.filter(function (e) {
                                                        return lt(e) === l;
                                                    })
                                              : ke),
                                          (c = (i =
                                              0 ===
                                              (i = e.filter(function (e) {
                                                  return 0 <= u.indexOf(e);
                                              })).length
                                                  ? e
                                                  : i).reduce(function (e, t) {
                                              return (
                                                  (e[t] = Ct(n, {
                                                      placement: t,
                                                      boundary: o,
                                                      rootBoundary: r,
                                                      padding: s,
                                                  })[Ue(t)]),
                                                  e
                                              );
                                          }, {})),
                                          Object.keys(c).sort(function (e, t) {
                                              return c[e] - c[t];
                                          }))
                                        : t
                                );
                                var n, i, o, r, s, a, u, l, c;
                            }, []),
                            y = h.rects.reference,
                            b = h.rects.popper,
                            _ = new Map(),
                            w = !0,
                            r = o[0],
                            x = 0;
                        x < o.length;
                        x++
                    ) {
                        var s = o[x],
                            E = Ue(s),
                            T = lt(s) === Ce,
                            a = 0 <= [A, S].indexOf(E),
                            l = a ? "width" : "height",
                            k = Ct(h, {
                                placement: s,
                                boundary: f,
                                rootBoundary: p,
                                altBoundary: g,
                                padding: d,
                            }),
                            a = a ? (T ? L : D) : T ? S : A,
                            T = (y[l] > b[l] && (a = gt(a)), gt(a)),
                            l = [];
                        if (
                            (c && l.push(k[E] <= 0),
                            u && l.push(k[a] <= 0, k[T] <= 0),
                            l.every(function (e) {
                                return e;
                            }))
                        ) {
                            (r = s), (w = !1);
                            break;
                        }
                        _.set(s, l);
                    }
                    if (w)
                        for (var C = m ? 3 : 1; 0 < C; C--)
                            if (
                                "break" ===
                                (function (t) {
                                    var e = o.find(function (e) {
                                        e = _.get(e);
                                        if (e)
                                            return e
                                                .slice(0, t)
                                                .every(function (e) {
                                                    return e;
                                                });
                                    });
                                    if (e) return (r = e), "break";
                                })(C)
                            )
                                break;
                    h.placement !== r &&
                        ((h.modifiersData[e]._skip = !0),
                        (h.placement = r),
                        (h.reset = !0));
                }
            },
            requiresIfExists: ["offset"],
            data: { _skip: !1 },
        };
        function St(e, t, n) {
            return {
                top:
                    e.top -
                    t.height -
                    (n = void 0 === n ? { x: 0, y: 0 } : n).y,
                right: e.right - t.width + n.x,
                bottom: e.bottom - t.height + n.y,
                left: e.left - t.width - n.x,
            };
        }
        function Lt(t) {
            return [A, L, S, D].some(function (e) {
                return 0 <= t[e];
            });
        }
        var Dt = {
            name: "hide",
            enabled: !0,
            phase: "main",
            requiresIfExists: ["preventOverflow"],
            fn: function (e) {
                var t = e.state,
                    e = e.name,
                    n = t.rects.reference,
                    i = t.rects.popper,
                    o = t.modifiersData.preventOverflow,
                    r = Ct(t, { elementContext: "reference" }),
                    s = Ct(t, { altBoundary: !0 }),
                    r = St(r, n),
                    n = St(s, i, o),
                    s = Lt(r),
                    i = Lt(n);
                (t.modifiersData[e] = {
                    referenceClippingOffsets: r,
                    popperEscapeOffsets: n,
                    isReferenceHidden: s,
                    hasPopperEscaped: i,
                }),
                    (t.attributes.popper = Object.assign(
                        {},
                        t.attributes.popper,
                        {
                            "data-popper-reference-hidden": s,
                            "data-popper-escaped": i,
                        }
                    ));
            },
        };
        var Nt = {
            name: "offset",
            enabled: !0,
            phase: "main",
            requires: ["popperOffsets"],
            fn: function (e) {
                var s = e.state,
                    t = e.options,
                    e = e.name,
                    a = void 0 === (t = t.offset) ? [0, 0] : t,
                    t = je.reduce(function (e, t) {
                        var n, i, o, r;
                        return (
                            (e[t] =
                                ((t = t),
                                (n = s.rects),
                                (i = a),
                                (o = Ue(t)),
                                (r = 0 <= [D, A].indexOf(o) ? -1 : 1),
                                (t =
                                    (n =
                                        "function" == typeof i
                                            ? i(
                                                  Object.assign({}, n, {
                                                      placement: t,
                                                  })
                                              )
                                            : i)[0] || 0),
                                (i = (n[1] || 0) * r),
                                0 <= [D, L].indexOf(o)
                                    ? { x: i, y: t }
                                    : { x: t, y: i })),
                            e
                        );
                    }, {}),
                    n = (i = t[s.placement]).x,
                    i = i.y;
                null != s.modifiersData.popperOffsets &&
                    ((s.modifiersData.popperOffsets.x += n),
                    (s.modifiersData.popperOffsets.y += i)),
                    (s.modifiersData[e] = t);
            },
        };
        var Ot = {
            name: "popperOffsets",
            enabled: !0,
            phase: "read",
            fn: function (e) {
                var t = e.state,
                    e = e.name;
                t.modifiersData[e] = kt({
                    reference: t.rects.reference,
                    element: t.rects.popper,
                    strategy: "absolute",
                    placement: t.placement,
                });
            },
            data: {},
        };
        var jt = {
            name: "preventOverflow",
            enabled: !0,
            phase: "main",
            fn: function (u) {
                var h,
                    d,
                    f,
                    p,
                    e,
                    g,
                    t,
                    n,
                    i,
                    o = u.state,
                    r = u.options,
                    u = u.name,
                    m = void 0 === (m = r.mainAxis) || m,
                    v = void 0 !== (v = r.altAxis) && v,
                    y = r.boundary,
                    s = r.rootBoundary,
                    b = r.altBoundary,
                    a = r.padding,
                    _ = void 0 === (_ = r.tether) || _,
                    r = void 0 === (r = r.tetherOffset) ? 0 : r,
                    y = Ct(o, {
                        boundary: y,
                        rootBoundary: s,
                        padding: a,
                        altBoundary: b,
                    }),
                    s = Ue(o.placement),
                    b = !(a = lt(o.placement)),
                    w = "x" === (s = et(s)) ? "y" : "x",
                    l = o.modifiersData.popperOffsets,
                    x = o.rects.reference,
                    c = o.rects.popper,
                    r =
                        "function" == typeof r
                            ? r(
                                  Object.assign({}, o.rects, {
                                      placement: o.placement,
                                  })
                              )
                            : r,
                    E = { x: 0, y: 0 };
                l &&
                    ((m || v) &&
                        ((e = "y" === s ? "height" : "width"),
                        (h = l[s]),
                        (d = l[s] + y[(i = "y" === s ? A : D)]),
                        (f = l[s] - y[(t = "y" === s ? S : L)]),
                        (g = _ ? -c[e] / 2 : 0),
                        (p = (a === Ce ? x : c)[e]),
                        (a = a === Ce ? -c[e] : -x[e]),
                        (c = o.elements.arrow),
                        (c = _ && c ? Ve(c) : { width: 0, height: 0 }),
                        (i = (n = o.modifiersData["arrow#persistent"]
                            ? o.modifiersData["arrow#persistent"].padding
                            : rt())[i]),
                        (n = n[t]),
                        (t = ot(0, x[e], c[e])),
                        (c = b ? x[e] / 2 - g - t - i - r : p - t - i - r),
                        (p = b ? -x[e] / 2 + g + t + n + r : a + t + n + r),
                        (b = (i = o.elements.arrow && Ze(o.elements.arrow))
                            ? "y" === s
                                ? i.clientTop || 0
                                : i.clientLeft || 0
                            : 0),
                        (x = o.modifiersData.offset
                            ? o.modifiersData.offset[o.placement][s]
                            : 0),
                        (e = l[s] + c - x - b),
                        (g = l[s] + p - x),
                        m &&
                            ((a = ot(_ ? nt(d, e) : d, h, _ ? tt(f, g) : f)),
                            (l[s] = a),
                            (E[s] = a - h)),
                        v &&
                            ((n = (t = l[w]) + y["x" === s ? A : D]),
                            (r = t - y["x" === s ? S : L]),
                            (i = ot(_ ? nt(n, e) : n, t, _ ? tt(r, g) : r)),
                            (l[w] = i),
                            (E[w] = i - t))),
                    (o.modifiersData[u] = E));
            },
            requiresIfExists: ["offset"],
        };
        function It(e, t, n) {
            void 0 === n && (n = !1);
            var i = ze(t),
                o =
                    (ze(t) &&
                        ((r = (o = t).getBoundingClientRect()).width,
                        o.offsetWidth,
                        (r = r.height / o.offsetHeight || 1)),
                    Ge(t)),
                r = Xe(e),
                e = { scrollLeft: 0, scrollTop: 0 },
                s = { x: 0, y: 0 };
            return (
                (!i && n) ||
                    (("body" === Be(t) && !_t(o)) ||
                        (e =
                            (i = t) !== We(i) && ze(i)
                                ? {
                                      scrollLeft: i.scrollLeft,
                                      scrollTop: i.scrollTop,
                                  }
                                : yt(i)),
                    ze(t)
                        ? (((s = Xe(t)).x += t.clientLeft),
                          (s.y += t.clientTop))
                        : o && (s.x = bt(o))),
                {
                    x: r.left + e.scrollLeft - s.x,
                    y: r.top + e.scrollTop - s.y,
                    width: r.width,
                    height: r.height,
                }
            );
        }
        function Pt(e) {
            var n = new Map(),
                i = new Set(),
                o = [];
            return (
                e.forEach(function (e) {
                    n.set(e.name, e);
                }),
                e.forEach(function (e) {
                    i.has(e.name) ||
                        !(function t(e) {
                            i.add(e.name),
                                []
                                    .concat(
                                        e.requires || [],
                                        e.requiresIfExists || []
                                    )
                                    .forEach(function (e) {
                                        i.has(e) || ((e = n.get(e)) && t(e));
                                    }),
                                o.push(e);
                        })(e);
                }),
                o
            );
        }
        var Ht = { placement: "bottom", modifiers: [], strategy: "absolute" };
        function Mt() {
            for (var e = arguments.length, t = new Array(e), n = 0; n < e; n++)
                t[n] = arguments[n];
            return !t.some(function (e) {
                return !(e && "function" == typeof e.getBoundingClientRect);
            });
        }
        function qt(e) {
            var e = (e = void 0 === e ? {} : e),
                t = e.defaultModifiers,
                h = void 0 === t ? [] : t,
                t = e.defaultOptions,
                d = void 0 === t ? Ht : t;
            return function (i, o, t) {
                void 0 === t && (t = d);
                var n,
                    r,
                    s = {
                        placement: "bottom",
                        orderedModifiers: [],
                        options: Object.assign({}, Ht, d),
                        modifiersData: {},
                        elements: { reference: i, popper: o },
                        attributes: {},
                        styles: {},
                    },
                    a = [],
                    l = !1,
                    c = {
                        state: s,
                        setOptions: function (e) {
                            var n,
                                t,
                                e = "function" == typeof e ? e(s.options) : e,
                                e =
                                    (u(),
                                    (s.options = Object.assign(
                                        {},
                                        d,
                                        s.options,
                                        e
                                    )),
                                    (s.scrollParents = {
                                        reference: Fe(i)
                                            ? wt(i)
                                            : i.contextElement
                                            ? wt(i.contextElement)
                                            : [],
                                        popper: wt(o),
                                    }),
                                    (e = [].concat(h, s.options.modifiers)),
                                    (t = e.reduce(function (e, t) {
                                        var n = e[t.name];
                                        return (
                                            (e[t.name] = n
                                                ? Object.assign({}, n, t, {
                                                      options: Object.assign(
                                                          {},
                                                          n.options,
                                                          t.options
                                                      ),
                                                      data: Object.assign(
                                                          {},
                                                          n.data,
                                                          t.data
                                                      ),
                                                  })
                                                : t),
                                            e
                                        );
                                    }, {})),
                                    (e = Object.keys(t).map(function (e) {
                                        return t[e];
                                    })),
                                    (n = Pt(e)),
                                    Re.reduce(function (e, t) {
                                        return e.concat(
                                            n.filter(function (e) {
                                                return e.phase === t;
                                            })
                                        );
                                    }, []));
                            return (
                                (s.orderedModifiers = e.filter(function (e) {
                                    return e.enabled;
                                })),
                                s.orderedModifiers.forEach(function (e) {
                                    var t = e.name,
                                        n = e.options,
                                        e = e.effect;
                                    "function" == typeof e &&
                                        ((e = e({
                                            state: s,
                                            name: t,
                                            instance: c,
                                            options: void 0 === n ? {} : n,
                                        })),
                                        a.push(e || function () {}));
                                }),
                                c.update()
                            );
                        },
                        forceUpdate: function () {
                            if (!l) {
                                var e = s.elements,
                                    t = e.reference,
                                    e = e.popper;
                                if (Mt(t, e)) {
                                    (s.rects = {
                                        reference: It(
                                            t,
                                            Ze(e),
                                            "fixed" === s.options.strategy
                                        ),
                                        popper: Ve(e),
                                    }),
                                        (s.reset = !1),
                                        (s.placement = s.options.placement),
                                        s.orderedModifiers.forEach(function (
                                            e
                                        ) {
                                            return (s.modifiersData[e.name] =
                                                Object.assign({}, e.data));
                                        });
                                    for (
                                        var n, i, o, r = 0;
                                        r < s.orderedModifiers.length;
                                        r++
                                    )
                                        !0 !== s.reset
                                            ? ((n = (o = s.orderedModifiers[r])
                                                  .fn),
                                              (i = o.options),
                                              (o = o.name),
                                              "function" == typeof n &&
                                                  (s =
                                                      n({
                                                          state: s,
                                                          options:
                                                              void 0 === i
                                                                  ? {}
                                                                  : i,
                                                          name: o,
                                                          instance: c,
                                                      }) || s))
                                            : ((s.reset = !1), (r = -1));
                                }
                            }
                        },
                        update:
                            ((n = function () {
                                return new Promise(function (e) {
                                    c.forceUpdate(), e(s);
                                });
                            }),
                            function () {
                                return (r =
                                    r ||
                                    new Promise(function (e) {
                                        Promise.resolve().then(function () {
                                            (r = void 0), e(n());
                                        });
                                    }));
                            }),
                        destroy: function () {
                            u(), (l = !0);
                        },
                    };
                return (
                    Mt(i, o) &&
                        c.setOptions(t).then(function (e) {
                            !l && t.onFirstUpdate && t.onFirstUpdate(e);
                        }),
                    c
                );
                function u() {
                    a.forEach(function (e) {
                        return e();
                    }),
                        (a = []);
                }
            };
        }
        var Rt = qt({ defaultModifiers: [ft, Ot, ht, e, Nt, At, jt, t, Dt] });
        const Bt = Object.freeze({
                __proto__: null,
                popperGenerator: qt,
                detectOverflow: Ct,
                createPopperBase: qt(),
                createPopper: Rt,
                createPopperLite: qt({ defaultModifiers: [ft, Ot, ht, e] }),
                top: A,
                bottom: S,
                right: L,
                left: D,
                auto: Te,
                basePlacements: ke,
                start: Ce,
                end: Ae,
                clippingParents: Se,
                viewport: Le,
                popper: De,
                reference: Ne,
                variationPlacements: Oe,
                placements: je,
                beforeRead: te,
                read: "read",
                afterRead: Ie,
                beforeMain: Pe,
                main: "main",
                afterMain: He,
                beforeWrite: Me,
                write: "write",
                afterWrite: qe,
                modifierPhases: Re,
                applyStyles: e,
                arrow: t,
                computeStyles: ht,
                eventListeners: ft,
                flip: At,
                hide: Dt,
                offset: Nt,
                popperOffsets: Ot,
                preventOverflow: jt,
            }),
            Wt = "dropdown";
        (te = ".bs.dropdown"), (Ie = ".data-api");
        const Ft = "Escape",
            zt = "ArrowUp",
            $t = "ArrowDown",
            Ut = new RegExp(zt + `|${$t}|` + Ft);
        (Pe = "click" + te + Ie), (He = "keydown" + te + Ie);
        const Xt = "show",
            Vt = '[data-bs-toggle="dropdown"]',
            Yt = ".dropdown-menu",
            Qt = i() ? "top-end" : "top-start",
            Gt = i() ? "top-start" : "top-end",
            Kt = i() ? "bottom-end" : "bottom-start",
            Jt = i() ? "bottom-start" : "bottom-end",
            Zt = i() ? "left-start" : "right-start",
            en = i() ? "right-start" : "left-start",
            tn = {
                offset: [0, 2],
                boundary: "clippingParents",
                reference: "toggle",
                display: "dynamic",
                popperConfig: null,
                autoClose: !0,
            },
            nn = {
                offset: "(array|string|function)",
                boundary: "(string|element)",
                reference: "(string|element|object)",
                display: "string",
                popperConfig: "(null|object|function)",
                autoClose: "(boolean|string)",
            };
        class on extends V {
            constructor(e, t) {
                super(e),
                    (this._popper = null),
                    (this._config = this._getConfig(t)),
                    (this._menu = this._getMenuElement()),
                    (this._inNavbar = this._detectNavbar());
            }
            static get Default() {
                return tn;
            }
            static get DefaultType() {
                return nn;
            }
            static get NAME() {
                return Wt;
            }
            toggle() {
                return this._isShown() ? this.hide() : this.show();
            }
            show() {
                if (!g(this._element) && !this._isShown(this._menu)) {
                    var e = { relatedTarget: this._element };
                    if (
                        !v.trigger(this._element, "show.bs.dropdown", e)
                            .defaultPrevented
                    ) {
                        const t = on.getParentFromElement(this._element);
                        this._inNavbar
                            ? r.setDataAttribute(this._menu, "popper", "none")
                            : this._createPopper(t),
                            "ontouchstart" in document.documentElement &&
                                !t.closest(".navbar-nav") &&
                                []
                                    .concat(...document.body.children)
                                    .forEach((e) => v.on(e, "mouseover", y)),
                            this._element.focus(),
                            this._element.setAttribute("aria-expanded", !0),
                            this._menu.classList.add(Xt),
                            this._element.classList.add(Xt),
                            v.trigger(this._element, "shown.bs.dropdown", e);
                    }
                }
            }
            hide() {
                var e;
                !g(this._element) &&
                    this._isShown(this._menu) &&
                    ((e = { relatedTarget: this._element }),
                    this._completeHide(e));
            }
            dispose() {
                this._popper && this._popper.destroy(), super.dispose();
            }
            update() {
                (this._inNavbar = this._detectNavbar()),
                    this._popper && this._popper.update();
            }
            _completeHide(e) {
                v.trigger(this._element, "hide.bs.dropdown", e)
                    .defaultPrevented ||
                    ("ontouchstart" in document.documentElement &&
                        []
                            .concat(...document.body.children)
                            .forEach((e) => v.off(e, "mouseover", y)),
                    this._popper && this._popper.destroy(),
                    this._menu.classList.remove(Xt),
                    this._element.classList.remove(Xt),
                    this._element.setAttribute("aria-expanded", "false"),
                    r.removeDataAttribute(this._menu, "popper"),
                    v.trigger(this._element, "hidden.bs.dropdown", e));
            }
            _getConfig(e) {
                if (
                    ((e = {
                        ...this.constructor.Default,
                        ...r.getDataAttributes(this._element),
                        ...e,
                    }),
                    f(Wt, e, this.constructor.DefaultType),
                    "object" == typeof e.reference &&
                        !d(e.reference) &&
                        "function" != typeof e.reference.getBoundingClientRect)
                )
                    throw new TypeError(
                        Wt.toUpperCase() +
                            ': Option "reference" provided type "object" without a required "getBoundingClientRect" method.'
                    );
                return e;
            }
            _createPopper(e) {
                if (void 0 === Bt)
                    throw new TypeError(
                        "Bootstrap's dropdowns require Popper (https://popper.js.org)"
                    );
                let t = this._element;
                "parent" === this._config.reference
                    ? (t = e)
                    : d(this._config.reference)
                    ? (t = o(this._config.reference))
                    : "object" == typeof this._config.reference &&
                      (t = this._config.reference);
                const n = this._getPopperConfig();
                e = n.modifiers.find(
                    (e) => "applyStyles" === e.name && !1 === e.enabled
                );
                (this._popper = Rt(t, this._menu, n)),
                    e && r.setDataAttribute(this._menu, "popper", "static");
            }
            _isShown(e = this._element) {
                return e.classList.contains(Xt);
            }
            _getMenuElement() {
                return h.next(this._element, Yt)[0];
            }
            _getPlacement() {
                const e = this._element.parentNode;
                if (e.classList.contains("dropend")) return Zt;
                if (e.classList.contains("dropstart")) return en;
                var t =
                    "end" ===
                    getComputedStyle(this._menu)
                        .getPropertyValue("--bs-position")
                        .trim();
                return e.classList.contains("dropup")
                    ? t
                        ? Gt
                        : Qt
                    : t
                    ? Jt
                    : Kt;
            }
            _detectNavbar() {
                return null !== this._element.closest(".navbar");
            }
            _getOffset() {
                const t = this._config["offset"];
                return "string" == typeof t
                    ? t.split(",").map((e) => Number.parseInt(e, 10))
                    : "function" == typeof t
                    ? (e) => t(e, this._element)
                    : t;
            }
            _getPopperConfig() {
                const e = {
                    placement: this._getPlacement(),
                    modifiers: [
                        {
                            name: "preventOverflow",
                            options: { boundary: this._config.boundary },
                        },
                        {
                            name: "offset",
                            options: { offset: this._getOffset() },
                        },
                    ],
                };
                return (
                    "static" === this._config.display &&
                        (e.modifiers = [{ name: "applyStyles", enabled: !1 }]),
                    {
                        ...e,
                        ...("function" == typeof this._config.popperConfig
                            ? this._config.popperConfig(e)
                            : this._config.popperConfig),
                    }
                );
            }
            _selectMenuItem({ key: e, target: t }) {
                const n = h
                    .find(
                        ".dropdown-menu .dropdown-item:not(.disabled):not(:disabled)",
                        this._menu
                    )
                    .filter(p);
                n.length && k(n, t, e === $t, !n.includes(t)).focus();
            }
            static jQueryInterface(t) {
                return this.each(function () {
                    const e = on.getOrCreateInstance(this, t);
                    if ("string" == typeof t) {
                        if (void 0 === e[t])
                            throw new TypeError(`No method named "${t}"`);
                        e[t]();
                    }
                });
            }
            static clearMenus(n) {
                if (
                    !n ||
                    (2 !== n.button && ("keyup" !== n.type || "Tab" === n.key))
                ) {
                    var i = h.find(Vt);
                    for (let e = 0, t = i.length; e < t; e++) {
                        const r = on.getInstance(i[e]);
                        if (r && !1 !== r._config.autoClose && r._isShown()) {
                            const s = { relatedTarget: r._element };
                            if (n) {
                                const a = n.composedPath();
                                var o = a.includes(r._menu);
                                if (
                                    a.includes(r._element) ||
                                    ("inside" === r._config.autoClose && !o) ||
                                    ("outside" === r._config.autoClose && o)
                                )
                                    continue;
                                if (
                                    r._menu.contains(n.target) &&
                                    (("keyup" === n.type && "Tab" === n.key) ||
                                        /input|select|option|textarea|form/i.test(
                                            n.target.tagName
                                        ))
                                )
                                    continue;
                                "click" === n.type && (s.clickEvent = n);
                            }
                            r._completeHide(s);
                        }
                    }
                }
            }
            static getParentFromElement(e) {
                return c(e) || e.parentNode;
            }
            static dataApiKeydownHandler(e) {
                if (
                    /input|textarea/i.test(e.target.tagName)
                        ? !(
                              "Space" === e.key ||
                              (e.key !== Ft &&
                                  ((e.key !== $t && e.key !== zt) ||
                                      e.target.closest(Yt)))
                          )
                        : Ut.test(e.key)
                ) {
                    var t = this.classList.contains(Xt);
                    if (
                        (t || e.key !== Ft) &&
                        (e.preventDefault(), e.stopPropagation(), !g(this))
                    ) {
                        var n = this.matches(Vt) ? this : h.prev(this, Vt)[0];
                        const i = on.getOrCreateInstance(n);
                        if (e.key !== Ft)
                            return e.key === zt || e.key === $t
                                ? (t || i.show(), void i._selectMenuItem(e))
                                : void (
                                      (t && "Space" !== e.key) ||
                                      on.clearMenus()
                                  );
                        i.hide();
                    }
                }
            }
        }
        v.on(document, He, Vt, on.dataApiKeydownHandler),
            v.on(document, He, Yt, on.dataApiKeydownHandler),
            v.on(document, Pe, on.clearMenus),
            v.on(document, "keyup.bs.dropdown.data-api", on.clearMenus),
            v.on(document, Pe, Vt, function (e) {
                e.preventDefault(), on.getOrCreateInstance(this).toggle();
            }),
            x(on);
        const rn = ".fixed-top, .fixed-bottom, .is-fixed, .sticky-top",
            sn = ".sticky-top";
        class an {
            constructor() {
                this._element = document.body;
            }
            getWidth() {
                var e = document.documentElement.clientWidth;
                return Math.abs(window.innerWidth - e);
            }
            hide() {
                const t = this.getWidth();
                this._disableOverFlow(),
                    this._setElementAttributes(
                        this._element,
                        "paddingRight",
                        (e) => e + t
                    ),
                    this._setElementAttributes(
                        rn,
                        "paddingRight",
                        (e) => e + t
                    ),
                    this._setElementAttributes(sn, "marginRight", (e) => e - t);
            }
            _disableOverFlow() {
                this._saveInitialAttribute(this._element, "overflow"),
                    (this._element.style.overflow = "hidden");
            }
            _setElementAttributes(e, n, i) {
                const o = this.getWidth();
                this._applyManipulationCallback(e, (e) => {
                    var t;
                    (e !== this._element &&
                        window.innerWidth > e.clientWidth + o) ||
                        (this._saveInitialAttribute(e, n),
                        (t = window.getComputedStyle(e)[n]),
                        (e.style[n] = i(Number.parseFloat(t)) + "px"));
                });
            }
            reset() {
                this._resetElementAttributes(this._element, "overflow"),
                    this._resetElementAttributes(this._element, "paddingRight"),
                    this._resetElementAttributes(rn, "paddingRight"),
                    this._resetElementAttributes(sn, "marginRight");
            }
            _saveInitialAttribute(e, t) {
                var n = e.style[t];
                n && r.setDataAttribute(e, t, n);
            }
            _resetElementAttributes(e, n) {
                this._applyManipulationCallback(e, (e) => {
                    var t = r.getDataAttribute(e, n);
                    void 0 === t
                        ? e.style.removeProperty(n)
                        : (r.removeDataAttribute(e, n), (e.style[n] = t));
                });
            }
            _applyManipulationCallback(e, t) {
                d(e) ? t(e) : h.find(e, this._element).forEach(t);
            }
            isOverflowing() {
                return 0 < this.getWidth();
            }
        }
        const ln = {
                className: "modal-backdrop",
                isVisible: !0,
                isAnimated: !1,
                rootElement: "body",
                clickCallback: null,
            },
            cn = {
                className: "string",
                isVisible: "boolean",
                isAnimated: "boolean",
                rootElement: "(element|string)",
                clickCallback: "(function|null)",
            },
            un = "backdrop",
            hn = "mousedown.bs." + un;
        class dn {
            constructor(e) {
                (this._config = this._getConfig(e)),
                    (this._isAppended = !1),
                    (this._element = null);
            }
            show(e) {
                this._config.isVisible
                    ? (this._append(),
                      this._config.isAnimated && b(this._getElement()),
                      this._getElement().classList.add("show"),
                      this._emulateAnimation(() => {
                          E(e);
                      }))
                    : E(e);
            }
            hide(e) {
                this._config.isVisible
                    ? (this._getElement().classList.remove("show"),
                      this._emulateAnimation(() => {
                          this.dispose(), E(e);
                      }))
                    : E(e);
            }
            _getElement() {
                if (!this._element) {
                    const e = document.createElement("div");
                    (e.className = this._config.className),
                        this._config.isAnimated && e.classList.add("fade"),
                        (this._element = e);
                }
                return this._element;
            }
            _getConfig(e) {
                return (
                    ((e = {
                        ...ln,
                        ...("object" == typeof e ? e : {}),
                    }).rootElement = o(e.rootElement)),
                    f(un, e, cn),
                    e
                );
            }
            _append() {
                this._isAppended ||
                    (this._config.rootElement.append(this._getElement()),
                    v.on(this._getElement(), hn, () => {
                        E(this._config.clickCallback);
                    }),
                    (this._isAppended = !0));
            }
            dispose() {
                this._isAppended &&
                    (v.off(this._element, hn),
                    this._element.remove(),
                    (this._isAppended = !1));
            }
            _emulateAnimation(e) {
                T(e, this._getElement(), this._config.isAnimated);
            }
        }
        const fn = { trapElement: null, autofocus: !0 },
            pn = { trapElement: "element", autofocus: "boolean" };
        const gn = ".bs.focustrap",
            mn = (gn, gn, "backward");
        class vn {
            constructor(e) {
                (this._config = this._getConfig(e)),
                    (this._isActive = !1),
                    (this._lastTabNavDirection = null);
            }
            activate() {
                const { trapElement: e, autofocus: t } = this._config;
                this._isActive ||
                    (t && e.focus(),
                    v.off(document, gn),
                    v.on(document, "focusin.bs.focustrap", (e) =>
                        this._handleFocusin(e)
                    ),
                    v.on(document, "keydown.tab.bs.focustrap", (e) =>
                        this._handleKeydown(e)
                    ),
                    (this._isActive = !0));
            }
            deactivate() {
                this._isActive && ((this._isActive = !1), v.off(document, gn));
            }
            _handleFocusin(e) {
                e = e.target;
                const t = this._config["trapElement"];
                if (e !== document && e !== t && !t.contains(e)) {
                    const n = h.focusableChildren(t);
                    (0 === n.length
                        ? t
                        : this._lastTabNavDirection === mn
                        ? n[n.length - 1]
                        : n[0]
                    ).focus();
                }
            }
            _handleKeydown(e) {
                "Tab" === e.key &&
                    (this._lastTabNavDirection = e.shiftKey ? mn : "forward");
            }
            _getConfig(e) {
                return (
                    (e = { ...fn, ...("object" == typeof e ? e : {}) }),
                    f("focustrap", e, pn),
                    e
                );
            }
        }
        const yn = ".bs.modal";
        const bn = { backdrop: !0, keyboard: !0, focus: !0 },
            _n = {
                backdrop: "(boolean|string)",
                keyboard: "boolean",
                focus: "boolean",
            },
            wn = (yn, yn, "hidden" + yn),
            xn = "show" + yn,
            En = (yn, "resize" + yn),
            Tn = "click.dismiss" + yn,
            kn = "keydown.dismiss" + yn,
            Cn = (yn, "mousedown.dismiss" + yn);
        yn;
        const An = "modal-open",
            Sn = "modal-static";
        class Ln extends V {
            constructor(e, t) {
                super(e),
                    (this._config = this._getConfig(t)),
                    (this._dialog = h.findOne(".modal-dialog", this._element)),
                    (this._backdrop = this._initializeBackDrop()),
                    (this._focustrap = this._initializeFocusTrap()),
                    (this._isShown = !1),
                    (this._ignoreBackdropClick = !1),
                    (this._isTransitioning = !1),
                    (this._scrollBar = new an());
            }
            static get Default() {
                return bn;
            }
            static get NAME() {
                return "modal";
            }
            toggle(e) {
                return this._isShown ? this.hide() : this.show(e);
            }
            show(e) {
                this._isShown ||
                    this._isTransitioning ||
                    v.trigger(this._element, xn, { relatedTarget: e })
                        .defaultPrevented ||
                    ((this._isShown = !0),
                    this._isAnimated() && (this._isTransitioning = !0),
                    this._scrollBar.hide(),
                    document.body.classList.add(An),
                    this._adjustDialog(),
                    this._setEscapeEvent(),
                    this._setResizeEvent(),
                    v.on(this._dialog, Cn, () => {
                        v.one(
                            this._element,
                            "mouseup.dismiss.bs.modal",
                            (e) => {
                                e.target === this._element &&
                                    (this._ignoreBackdropClick = !0);
                            }
                        );
                    }),
                    this._showBackdrop(() => this._showElement(e)));
            }
            hide() {
                var e;
                this._isShown &&
                    !this._isTransitioning &&
                    (v.trigger(this._element, "hide.bs.modal")
                        .defaultPrevented ||
                        ((this._isShown = !1),
                        (e = this._isAnimated()) &&
                            (this._isTransitioning = !0),
                        this._setEscapeEvent(),
                        this._setResizeEvent(),
                        this._focustrap.deactivate(),
                        this._element.classList.remove("show"),
                        v.off(this._element, Tn),
                        v.off(this._dialog, Cn),
                        this._queueCallback(
                            () => this._hideModal(),
                            this._element,
                            e
                        )));
            }
            dispose() {
                [window, this._dialog].forEach((e) => v.off(e, yn)),
                    this._backdrop.dispose(),
                    this._focustrap.deactivate(),
                    super.dispose();
            }
            handleUpdate() {
                this._adjustDialog();
            }
            _initializeBackDrop() {
                return new dn({
                    isVisible: Boolean(this._config.backdrop),
                    isAnimated: this._isAnimated(),
                });
            }
            _initializeFocusTrap() {
                return new vn({ trapElement: this._element });
            }
            _getConfig(e) {
                return (
                    (e = {
                        ...bn,
                        ...r.getDataAttributes(this._element),
                        ...("object" == typeof e ? e : {}),
                    }),
                    f("modal", e, _n),
                    e
                );
            }
            _showElement(e) {
                var t = this._isAnimated();
                const n = h.findOne(".modal-body", this._dialog);
                (this._element.parentNode &&
                    this._element.parentNode.nodeType === Node.ELEMENT_NODE) ||
                    document.body.append(this._element),
                    (this._element.style.display = "block"),
                    this._element.removeAttribute("aria-hidden"),
                    this._element.setAttribute("aria-modal", !0),
                    this._element.setAttribute("role", "dialog"),
                    (this._element.scrollTop = 0),
                    n && (n.scrollTop = 0),
                    t && b(this._element),
                    this._element.classList.add("show");
                this._queueCallback(
                    () => {
                        this._config.focus && this._focustrap.activate(),
                            (this._isTransitioning = !1),
                            v.trigger(this._element, "shown.bs.modal", {
                                relatedTarget: e,
                            });
                    },
                    this._dialog,
                    t
                );
            }
            _setEscapeEvent() {
                this._isShown
                    ? v.on(this._element, kn, (e) => {
                          this._config.keyboard && "Escape" === e.key
                              ? (e.preventDefault(), this.hide())
                              : this._config.keyboard ||
                                "Escape" !== e.key ||
                                this._triggerBackdropTransition();
                      })
                    : v.off(this._element, kn);
            }
            _setResizeEvent() {
                this._isShown
                    ? v.on(window, En, () => this._adjustDialog())
                    : v.off(window, En);
            }
            _hideModal() {
                (this._element.style.display = "none"),
                    this._element.setAttribute("aria-hidden", !0),
                    this._element.removeAttribute("aria-modal"),
                    this._element.removeAttribute("role"),
                    (this._isTransitioning = !1),
                    this._backdrop.hide(() => {
                        document.body.classList.remove(An),
                            this._resetAdjustments(),
                            this._scrollBar.reset(),
                            v.trigger(this._element, wn);
                    });
            }
            _showBackdrop(e) {
                v.on(this._element, Tn, (e) => {
                    this._ignoreBackdropClick
                        ? (this._ignoreBackdropClick = !1)
                        : e.target === e.currentTarget &&
                          (!0 === this._config.backdrop
                              ? this.hide()
                              : "static" === this._config.backdrop &&
                                this._triggerBackdropTransition());
                }),
                    this._backdrop.show(e);
            }
            _isAnimated() {
                return this._element.classList.contains("fade");
            }
            _triggerBackdropTransition() {
                if (
                    !v.trigger(this._element, "hidePrevented.bs.modal")
                        .defaultPrevented
                ) {
                    const {
                            classList: e,
                            scrollHeight: t,
                            style: n,
                        } = this._element,
                        i = t > document.documentElement.clientHeight;
                    (!i && "hidden" === n.overflowY) ||
                        e.contains(Sn) ||
                        (i || (n.overflowY = "hidden"),
                        e.add(Sn),
                        this._queueCallback(() => {
                            e.remove(Sn),
                                i ||
                                    this._queueCallback(() => {
                                        n.overflowY = "";
                                    }, this._dialog);
                        }, this._dialog),
                        this._element.focus());
                }
            }
            _adjustDialog() {
                var e =
                        this._element.scrollHeight >
                        document.documentElement.clientHeight,
                    t = this._scrollBar.getWidth(),
                    n = 0 < t;
                ((!n && e && !i()) || (n && !e && i())) &&
                    (this._element.style.paddingLeft = t + "px"),
                    ((n && !e && !i()) || (!n && e && i())) &&
                        (this._element.style.paddingRight = t + "px");
            }
            _resetAdjustments() {
                (this._element.style.paddingLeft = ""),
                    (this._element.style.paddingRight = "");
            }
            static jQueryInterface(t, n) {
                return this.each(function () {
                    const e = Ln.getOrCreateInstance(this, t);
                    if ("string" == typeof t) {
                        if (void 0 === e[t])
                            throw new TypeError(`No method named "${t}"`);
                        e[t](n);
                    }
                });
            }
        }
        v.on(
            document,
            "click.bs.modal.data-api",
            '[data-bs-toggle="modal"]',
            function (e) {
                const t = c(this);
                ["A", "AREA"].includes(this.tagName) && e.preventDefault(),
                    v.one(t, xn, (e) => {
                        e.defaultPrevented ||
                            v.one(t, wn, () => {
                                p(this) && this.focus();
                            });
                    });
                e = h.findOne(".modal.show");
                e && Ln.getInstance(e).hide();
                const n = Ln.getOrCreateInstance(t);
                n.toggle(this);
            }
        ),
            Y(Ln),
            x(Ln);
        const Dn = "offcanvas";
        Me = ".bs.offcanvas";
        const Nn = { backdrop: !0, keyboard: !0, scroll: !1 },
            On = {
                backdrop: "boolean",
                keyboard: "boolean",
                scroll: "boolean",
            },
            jn = ".offcanvas.show",
            In = "hidden" + Me;
        class Pn extends V {
            constructor(e, t) {
                super(e),
                    (this._config = this._getConfig(t)),
                    (this._isShown = !1),
                    (this._backdrop = this._initializeBackDrop()),
                    (this._focustrap = this._initializeFocusTrap()),
                    this._addEventListeners();
            }
            static get NAME() {
                return Dn;
            }
            static get Default() {
                return Nn;
            }
            toggle(e) {
                return this._isShown ? this.hide() : this.show(e);
            }
            show(e) {
                this._isShown ||
                    v.trigger(this._element, "show.bs.offcanvas", {
                        relatedTarget: e,
                    }).defaultPrevented ||
                    ((this._isShown = !0),
                    (this._element.style.visibility = "visible"),
                    this._backdrop.show(),
                    this._config.scroll || new an().hide(),
                    this._element.removeAttribute("aria-hidden"),
                    this._element.setAttribute("aria-modal", !0),
                    this._element.setAttribute("role", "dialog"),
                    this._element.classList.add("show"),
                    this._queueCallback(
                        () => {
                            this._config.scroll || this._focustrap.activate(),
                                v.trigger(this._element, "shown.bs.offcanvas", {
                                    relatedTarget: e,
                                });
                        },
                        this._element,
                        !0
                    ));
            }
            hide() {
                this._isShown &&
                    (v.trigger(this._element, "hide.bs.offcanvas")
                        .defaultPrevented ||
                        (this._focustrap.deactivate(),
                        this._element.blur(),
                        (this._isShown = !1),
                        this._element.classList.remove("show"),
                        this._backdrop.hide(),
                        this._queueCallback(
                            () => {
                                this._element.setAttribute("aria-hidden", !0),
                                    this._element.removeAttribute("aria-modal"),
                                    this._element.removeAttribute("role"),
                                    (this._element.style.visibility = "hidden"),
                                    this._config.scroll || new an().reset(),
                                    v.trigger(this._element, In);
                            },
                            this._element,
                            !0
                        )));
            }
            dispose() {
                this._backdrop.dispose(),
                    this._focustrap.deactivate(),
                    super.dispose();
            }
            _getConfig(e) {
                return (
                    (e = {
                        ...Nn,
                        ...r.getDataAttributes(this._element),
                        ...("object" == typeof e ? e : {}),
                    }),
                    f(Dn, e, On),
                    e
                );
            }
            _initializeBackDrop() {
                return new dn({
                    className: "offcanvas-backdrop",
                    isVisible: this._config.backdrop,
                    isAnimated: !0,
                    rootElement: this._element.parentNode,
                    clickCallback: () => this.hide(),
                });
            }
            _initializeFocusTrap() {
                return new vn({ trapElement: this._element });
            }
            _addEventListeners() {
                v.on(this._element, "keydown.dismiss.bs.offcanvas", (e) => {
                    this._config.keyboard && "Escape" === e.key && this.hide();
                });
            }
            static jQueryInterface(t) {
                return this.each(function () {
                    const e = Pn.getOrCreateInstance(this, t);
                    if ("string" == typeof t) {
                        if (
                            void 0 === e[t] ||
                            t.startsWith("_") ||
                            "constructor" === t
                        )
                            throw new TypeError(`No method named "${t}"`);
                        e[t](this);
                    }
                });
            }
        }
        v.on(
            document,
            "click.bs.offcanvas.data-api",
            '[data-bs-toggle="offcanvas"]',
            function (e) {
                var t = c(this);
                if (
                    (["A", "AREA"].includes(this.tagName) && e.preventDefault(),
                    !g(this))
                ) {
                    v.one(t, In, () => {
                        p(this) && this.focus();
                    });
                    e = h.findOne(jn);
                    e && e !== t && Pn.getInstance(e).hide();
                    const n = Pn.getOrCreateInstance(t);
                    n.toggle(this);
                }
            }
        ),
            v.on(window, "load.bs.offcanvas.data-api", () =>
                h.find(jn).forEach((e) => Pn.getOrCreateInstance(e).show())
            ),
            Y(Pn),
            x(Pn);
        const Hn = new Set([
            "background",
            "cite",
            "href",
            "itemtype",
            "longdesc",
            "poster",
            "src",
            "xlink:href",
        ]);
        const Mn =
                /^(?:(?:https?|mailto|ftp|tel|file|sms):|[^#&/:?]*(?:[#/?]|$))/i,
            qn =
                /^data:(?:image\/(?:bmp|gif|jpeg|jpg|png|tiff|webp)|video\/(?:mpeg|mp4|ogg|webm)|audio\/(?:mp3|oga|ogg|opus));base64,[\d+/a-z]+=*$/i;
        qe = {
            "*": ["class", "dir", "id", "lang", "role", /^aria-[\w-]*$/i],
            a: ["target", "href", "title", "rel"],
            area: [],
            b: [],
            br: [],
            col: [],
            code: [],
            div: [],
            em: [],
            hr: [],
            h1: [],
            h2: [],
            h3: [],
            h4: [],
            h5: [],
            h6: [],
            i: [],
            img: ["src", "srcset", "alt", "title", "width", "height"],
            li: [],
            ol: [],
            p: [],
            pre: [],
            s: [],
            small: [],
            span: [],
            sub: [],
            sup: [],
            strong: [],
            u: [],
            ul: [],
        };
        function Rn(e, n, t) {
            if (!e.length) return e;
            if (t && "function" == typeof t) return t(e);
            const i = new window.DOMParser(),
                o = i.parseFromString(e, "text/html");
            var r = [].concat(...o.body.querySelectorAll("*"));
            for (let e = 0, t = r.length; e < t; e++) {
                const a = r[e];
                var s = a.nodeName.toLowerCase();
                if (Object.keys(n).includes(s)) {
                    const l = [].concat(...a.attributes),
                        c = [].concat(n["*"] || [], n[s] || []);
                    l.forEach((e) => {
                        ((e, t) => {
                            var n = e.nodeName.toLowerCase();
                            if (t.includes(n))
                                return (
                                    !Hn.has(n) ||
                                    Boolean(
                                        Mn.test(e.nodeValue) ||
                                            qn.test(e.nodeValue)
                                    )
                                );
                            const i = t.filter((e) => e instanceof RegExp);
                            for (let e = 0, t = i.length; e < t; e++)
                                if (i[e].test(n)) return !0;
                            return !1;
                        })(e, c) || a.removeAttribute(e.nodeName);
                    });
                } else a.remove();
            }
            return o.body.innerHTML;
        }
        const Bn = "tooltip";
        e = ".bs.tooltip";
        const Wn = new Set(["sanitize", "allowList", "sanitizeFn"]),
            Fn = {
                animation: "boolean",
                template: "string",
                title: "(string|element|function)",
                trigger: "string",
                delay: "(number|object)",
                html: "boolean",
                selector: "(string|boolean)",
                placement: "(string|function)",
                offset: "(array|string|function)",
                container: "(string|element|boolean)",
                fallbackPlacements: "array",
                boundary: "(string|element)",
                customClass: "(string|function)",
                sanitize: "boolean",
                sanitizeFn: "(null|function)",
                allowList: "object",
                popperConfig: "(null|object|function)",
            },
            zn = {
                AUTO: "auto",
                TOP: "top",
                RIGHT: i() ? "left" : "right",
                BOTTOM: "bottom",
                LEFT: i() ? "right" : "left",
            },
            $n = {
                animation: !0,
                template:
                    '<div class="tooltip" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>',
                trigger: "hover focus",
                title: "",
                delay: 0,
                html: !1,
                selector: !1,
                placement: "top",
                offset: [0, 0],
                container: !1,
                fallbackPlacements: ["top", "right", "bottom", "left"],
                boundary: "clippingParents",
                customClass: "",
                sanitize: !0,
                sanitizeFn: null,
                allowList: qe,
                popperConfig: null,
            },
            Un = {
                HIDE: "hide" + e,
                HIDDEN: "hidden" + e,
                SHOW: "show" + e,
                SHOWN: "shown" + e,
                INSERTED: "inserted" + e,
                CLICK: "click" + e,
                FOCUSIN: "focusin" + e,
                FOCUSOUT: "focusout" + e,
                MOUSEENTER: "mouseenter" + e,
                MOUSELEAVE: "mouseleave" + e,
            },
            Xn = "fade";
        const Vn = "show",
            Yn = "show",
            Qn = ".tooltip-inner",
            Gn = "hide.bs.modal",
            Kn = "hover",
            Jn = "focus";
        class Zn extends V {
            constructor(e, t) {
                if (void 0 === Bt)
                    throw new TypeError(
                        "Bootstrap's tooltips require Popper (https://popper.js.org)"
                    );
                super(e),
                    (this._isEnabled = !0),
                    (this._timeout = 0),
                    (this._hoverState = ""),
                    (this._activeTrigger = {}),
                    (this._popper = null),
                    (this._config = this._getConfig(t)),
                    (this.tip = null),
                    this._setListeners();
            }
            static get Default() {
                return $n;
            }
            static get NAME() {
                return Bn;
            }
            static get Event() {
                return Un;
            }
            static get DefaultType() {
                return Fn;
            }
            enable() {
                this._isEnabled = !0;
            }
            disable() {
                this._isEnabled = !1;
            }
            toggleEnabled() {
                this._isEnabled = !this._isEnabled;
            }
            toggle(e) {
                if (this._isEnabled)
                    if (e) {
                        const t = this._initializeOnDelegatedTarget(e);
                        (t._activeTrigger.click = !t._activeTrigger.click),
                            t._isWithActiveTrigger()
                                ? t._enter(null, t)
                                : t._leave(null, t);
                    } else
                        this.getTipElement().classList.contains(Vn)
                            ? this._leave(null, this)
                            : this._enter(null, this);
            }
            dispose() {
                clearTimeout(this._timeout),
                    v.off(
                        this._element.closest(".modal"),
                        Gn,
                        this._hideModalHandler
                    ),
                    this.tip && this.tip.remove(),
                    this._disposePopper(),
                    super.dispose();
            }
            show() {
                if ("none" === this._element.style.display)
                    throw new Error("Please use show on visible elements");
                if (this.isWithContent() && this._isEnabled) {
                    var e = v.trigger(
                        this._element,
                        this.constructor.Event.SHOW
                    );
                    const n = m(this._element);
                    var t = (
                        null === n
                            ? this._element.ownerDocument.documentElement
                            : n
                    ).contains(this._element);
                    if (!e.defaultPrevented && t) {
                        "tooltip" === this.constructor.NAME &&
                            this.tip &&
                            this.getTitle() !==
                                this.tip.querySelector(Qn).innerHTML &&
                            (this._disposePopper(),
                            this.tip.remove(),
                            (this.tip = null));
                        const i = this.getTipElement();
                        (e = ((e) => {
                            for (
                                ;
                                (e += Math.floor(1e6 * Math.random())),
                                    document.getElementById(e);

                            );
                            return e;
                        })(this.constructor.NAME)),
                            (t =
                                (i.setAttribute("id", e),
                                this._element.setAttribute(
                                    "aria-describedby",
                                    e
                                ),
                                this._config.animation && i.classList.add(Xn),
                                "function" == typeof this._config.placement
                                    ? this._config.placement.call(
                                          this,
                                          i,
                                          this._element
                                      )
                                    : this._config.placement)),
                            (e = this._getAttachment(t));
                        this._addAttachmentClass(e);
                        const o = this._config["container"],
                            r =
                                (X.set(i, this.constructor.DATA_KEY, this),
                                this._element.ownerDocument.documentElement.contains(
                                    this.tip
                                ) ||
                                    (o.append(i),
                                    v.trigger(
                                        this._element,
                                        this.constructor.Event.INSERTED
                                    )),
                                this._popper
                                    ? this._popper.update()
                                    : (this._popper = Rt(
                                          this._element,
                                          i,
                                          this._getPopperConfig(e)
                                      )),
                                i.classList.add(Vn),
                                this._resolvePossibleFunction(
                                    this._config.customClass
                                ));
                        r && i.classList.add(...r.split(" ")),
                            "ontouchstart" in document.documentElement &&
                                []
                                    .concat(...document.body.children)
                                    .forEach((e) => {
                                        v.on(e, "mouseover", y);
                                    });
                        t = this.tip.classList.contains(Xn);
                        this._queueCallback(
                            () => {
                                var e = this._hoverState;
                                (this._hoverState = null),
                                    v.trigger(
                                        this._element,
                                        this.constructor.Event.SHOWN
                                    ),
                                    "out" === e && this._leave(null, this);
                            },
                            this.tip,
                            t
                        );
                    }
                }
            }
            hide() {
                if (this._popper) {
                    const t = this.getTipElement();
                    var e;
                    v.trigger(this._element, this.constructor.Event.HIDE)
                        .defaultPrevented ||
                        (t.classList.remove(Vn),
                        "ontouchstart" in document.documentElement &&
                            []
                                .concat(...document.body.children)
                                .forEach((e) => v.off(e, "mouseover", y)),
                        (this._activeTrigger.click = !1),
                        (this._activeTrigger[Jn] = !1),
                        (this._activeTrigger[Kn] = !1),
                        (e = this.tip.classList.contains(Xn)),
                        this._queueCallback(
                            () => {
                                this._isWithActiveTrigger() ||
                                    (this._hoverState !== Yn && t.remove(),
                                    this._cleanTipClass(),
                                    this._element.removeAttribute(
                                        "aria-describedby"
                                    ),
                                    v.trigger(
                                        this._element,
                                        this.constructor.Event.HIDDEN
                                    ),
                                    this._disposePopper());
                            },
                            this.tip,
                            e
                        ),
                        (this._hoverState = ""));
                }
            }
            update() {
                null !== this._popper && this._popper.update();
            }
            isWithContent() {
                return Boolean(this.getTitle());
            }
            getTipElement() {
                if (this.tip) return this.tip;
                const e = document.createElement("div"),
                    t = ((e.innerHTML = this._config.template), e.children[0]);
                return (
                    this.setContent(t),
                    t.classList.remove(Xn, Vn),
                    (this.tip = t),
                    this.tip
                );
            }
            setContent(e) {
                this._sanitizeAndSetContent(e, this.getTitle(), Qn);
            }
            _sanitizeAndSetContent(e, t, n) {
                const i = h.findOne(n, e);
                t || !i ? this.setElementContent(i, t) : i.remove();
            }
            setElementContent(e, t) {
                if (null !== e)
                    return d(t)
                        ? ((t = o(t)),
                          void (this._config.html
                              ? t.parentNode !== e &&
                                ((e.innerHTML = ""), e.append(t))
                              : (e.textContent = t.textContent)))
                        : void (this._config.html
                              ? (this._config.sanitize &&
                                    (t = Rn(
                                        t,
                                        this._config.allowList,
                                        this._config.sanitizeFn
                                    )),
                                (e.innerHTML = t))
                              : (e.textContent = t));
            }
            getTitle() {
                var e =
                    this._element.getAttribute("data-bs-original-title") ||
                    this._config.title;
                return this._resolvePossibleFunction(e);
            }
            updateAttachment(e) {
                return "right" === e ? "end" : "left" === e ? "start" : e;
            }
            _initializeOnDelegatedTarget(e, t) {
                return (
                    t ||
                    this.constructor.getOrCreateInstance(
                        e.delegateTarget,
                        this._getDelegateConfig()
                    )
                );
            }
            _getOffset() {
                const t = this._config["offset"];
                return "string" == typeof t
                    ? t.split(",").map((e) => Number.parseInt(e, 10))
                    : "function" == typeof t
                    ? (e) => t(e, this._element)
                    : t;
            }
            _resolvePossibleFunction(e) {
                return "function" == typeof e ? e.call(this._element) : e;
            }
            _getPopperConfig(e) {
                e = {
                    placement: e,
                    modifiers: [
                        {
                            name: "flip",
                            options: {
                                fallbackPlacements:
                                    this._config.fallbackPlacements,
                            },
                        },
                        {
                            name: "offset",
                            options: { offset: this._getOffset() },
                        },
                        {
                            name: "preventOverflow",
                            options: { boundary: this._config.boundary },
                        },
                        {
                            name: "arrow",
                            options: {
                                element: `.${this.constructor.NAME}-arrow`,
                            },
                        },
                        {
                            name: "onChange",
                            enabled: !0,
                            phase: "afterWrite",
                            fn: (e) => this._handlePopperPlacementChange(e),
                        },
                    ],
                    onFirstUpdate: (e) => {
                        e.options.placement !== e.placement &&
                            this._handlePopperPlacementChange(e);
                    },
                };
                return {
                    ...e,
                    ...("function" == typeof this._config.popperConfig
                        ? this._config.popperConfig(e)
                        : this._config.popperConfig),
                };
            }
            _addAttachmentClass(e) {
                this.getTipElement().classList.add(
                    this._getBasicClassPrefix() + "-" + this.updateAttachment(e)
                );
            }
            _getAttachment(e) {
                return zn[e.toUpperCase()];
            }
            _setListeners() {
                const e = this._config.trigger.split(" ");
                e.forEach((e) => {
                    var t;
                    "click" === e
                        ? v.on(
                              this._element,
                              this.constructor.Event.CLICK,
                              this._config.selector,
                              (e) => this.toggle(e)
                          )
                        : "manual" !== e &&
                          ((t =
                              e === Kn
                                  ? this.constructor.Event.MOUSEENTER
                                  : this.constructor.Event.FOCUSIN),
                          (e =
                              e === Kn
                                  ? this.constructor.Event.MOUSELEAVE
                                  : this.constructor.Event.FOCUSOUT),
                          v.on(this._element, t, this._config.selector, (e) =>
                              this._enter(e)
                          ),
                          v.on(this._element, e, this._config.selector, (e) =>
                              this._leave(e)
                          ));
                }),
                    (this._hideModalHandler = () => {
                        this._element && this.hide();
                    }),
                    v.on(
                        this._element.closest(".modal"),
                        Gn,
                        this._hideModalHandler
                    ),
                    this._config.selector
                        ? (this._config = {
                              ...this._config,
                              trigger: "manual",
                              selector: "",
                          })
                        : this._fixTitle();
            }
            _fixTitle() {
                var e = this._element.getAttribute("title"),
                    t = typeof this._element.getAttribute(
                        "data-bs-original-title"
                    );
                (!e && "string" == t) ||
                    (this._element.setAttribute(
                        "data-bs-original-title",
                        e || ""
                    ),
                    !e ||
                        this._element.getAttribute("aria-label") ||
                        this._element.textContent ||
                        this._element.setAttribute("aria-label", e),
                    this._element.setAttribute("title", ""));
            }
            _enter(e, t) {
                (t = this._initializeOnDelegatedTarget(e, t)),
                    e &&
                        (t._activeTrigger["focusin" === e.type ? Jn : Kn] = !0),
                    t.getTipElement().classList.contains(Vn) ||
                    t._hoverState === Yn
                        ? (t._hoverState = Yn)
                        : (clearTimeout(t._timeout),
                          (t._hoverState = Yn),
                          t._config.delay && t._config.delay.show
                              ? (t._timeout = setTimeout(() => {
                                    t._hoverState === Yn && t.show();
                                }, t._config.delay.show))
                              : t.show());
            }
            _leave(e, t) {
                (t = this._initializeOnDelegatedTarget(e, t)),
                    e &&
                        (t._activeTrigger["focusout" === e.type ? Jn : Kn] =
                            t._element.contains(e.relatedTarget)),
                    t._isWithActiveTrigger() ||
                        (clearTimeout(t._timeout),
                        (t._hoverState = "out"),
                        t._config.delay && t._config.delay.hide
                            ? (t._timeout = setTimeout(() => {
                                  "out" === t._hoverState && t.hide();
                              }, t._config.delay.hide))
                            : t.hide());
            }
            _isWithActiveTrigger() {
                for (const e in this._activeTrigger)
                    if (this._activeTrigger[e]) return !0;
                return !1;
            }
            _getConfig(e) {
                const t = r.getDataAttributes(this._element);
                return (
                    Object.keys(t).forEach((e) => {
                        Wn.has(e) && delete t[e];
                    }),
                    ((e = {
                        ...this.constructor.Default,
                        ...t,
                        ...("object" == typeof e && e ? e : {}),
                    }).container =
                        !1 === e.container ? document.body : o(e.container)),
                    "number" == typeof e.delay &&
                        (e.delay = { show: e.delay, hide: e.delay }),
                    "number" == typeof e.title &&
                        (e.title = e.title.toString()),
                    "number" == typeof e.content &&
                        (e.content = e.content.toString()),
                    f(Bn, e, this.constructor.DefaultType),
                    e.sanitize &&
                        (e.template = Rn(
                            e.template,
                            e.allowList,
                            e.sanitizeFn
                        )),
                    e
                );
            }
            _getDelegateConfig() {
                const e = {};
                for (const t in this._config)
                    this.constructor.Default[t] !== this._config[t] &&
                        (e[t] = this._config[t]);
                return e;
            }
            _cleanTipClass() {
                const t = this.getTipElement();
                var e = new RegExp(
                    `(^|\\s)${this._getBasicClassPrefix()}\\S+`,
                    "g"
                );
                const n = t.getAttribute("class").match(e);
                null !== n &&
                    0 < n.length &&
                    n
                        .map((e) => e.trim())
                        .forEach((e) => t.classList.remove(e));
            }
            _getBasicClassPrefix() {
                return "bs-tooltip";
            }
            _handlePopperPlacementChange(e) {
                e = e.state;
                e &&
                    ((this.tip = e.elements.popper),
                    this._cleanTipClass(),
                    this._addAttachmentClass(this._getAttachment(e.placement)));
            }
            _disposePopper() {
                this._popper && (this._popper.destroy(), (this._popper = null));
            }
            static jQueryInterface(t) {
                return this.each(function () {
                    const e = Zn.getOrCreateInstance(this, t);
                    if ("string" == typeof t) {
                        if (void 0 === e[t])
                            throw new TypeError(`No method named "${t}"`);
                        e[t]();
                    }
                });
            }
        }
        x(Zn);
        t = ".bs.popover";
        const ei = {
                ...Zn.Default,
                placement: "right",
                offset: [0, 8],
                trigger: "click",
                content: "",
                template:
                    '<div class="popover" role="tooltip"><div class="popover-arrow"></div><h3 class="popover-header"></h3><div class="popover-body"></div></div>',
            },
            ti = { ...Zn.DefaultType, content: "(string|element|function)" },
            ni = {
                HIDE: "hide" + t,
                HIDDEN: "hidden" + t,
                SHOW: "show" + t,
                SHOWN: "shown" + t,
                INSERTED: "inserted" + t,
                CLICK: "click" + t,
                FOCUSIN: "focusin" + t,
                FOCUSOUT: "focusout" + t,
                MOUSEENTER: "mouseenter" + t,
                MOUSELEAVE: "mouseleave" + t,
            };
        class ii extends Zn {
            static get Default() {
                return ei;
            }
            static get NAME() {
                return "popover";
            }
            static get Event() {
                return ni;
            }
            static get DefaultType() {
                return ti;
            }
            isWithContent() {
                return this.getTitle() || this._getContent();
            }
            setContent(e) {
                this._sanitizeAndSetContent(
                    e,
                    this.getTitle(),
                    ".popover-header"
                ),
                    this._sanitizeAndSetContent(
                        e,
                        this._getContent(),
                        ".popover-body"
                    );
            }
            _getContent() {
                return this._resolvePossibleFunction(this._config.content);
            }
            _getBasicClassPrefix() {
                return "bs-popover";
            }
            static jQueryInterface(t) {
                return this.each(function () {
                    const e = ii.getOrCreateInstance(this, t);
                    if ("string" == typeof t) {
                        if (void 0 === e[t])
                            throw new TypeError(`No method named "${t}"`);
                        e[t]();
                    }
                });
            }
        }
        x(ii);
        const oi = "scrollspy";
        const ri = ".bs.scrollspy";
        const si = { offset: 10, method: "auto", target: "" },
            ai = {
                offset: "number",
                method: "string",
                target: "(string|element)",
            };
        ri, ri;
        ri;
        const li = "dropdown-item",
            ci = "active",
            ui = ".nav-link",
            hi = ".list-group-item",
            di = ui + `, ${hi}, .` + li,
            fi = "position";
        class pi extends V {
            constructor(e, t) {
                super(e),
                    (this._scrollElement =
                        "BODY" === this._element.tagName
                            ? window
                            : this._element),
                    (this._config = this._getConfig(t)),
                    (this._offsets = []),
                    (this._targets = []),
                    (this._activeTarget = null),
                    (this._scrollHeight = 0),
                    v.on(this._scrollElement, "scroll.bs.scrollspy", () =>
                        this._process()
                    ),
                    this.refresh(),
                    this._process();
            }
            static get Default() {
                return si;
            }
            static get NAME() {
                return oi;
            }
            refresh() {
                var e =
                    this._scrollElement === this._scrollElement.window
                        ? "offset"
                        : fi;
                const i =
                        "auto" === this._config.method
                            ? e
                            : this._config.method,
                    o = i === fi ? this._getScrollTop() : 0,
                    t =
                        ((this._offsets = []),
                        (this._targets = []),
                        (this._scrollHeight = this._getScrollHeight()),
                        h.find(di, this._config.target));
                t.map((e) => {
                    e = l(e);
                    const t = e ? h.findOne(e) : null;
                    if (t) {
                        var n = t.getBoundingClientRect();
                        if (n.width || n.height) return [r[i](t).top + o, e];
                    }
                    return null;
                })
                    .filter((e) => e)
                    .sort((e, t) => e[0] - t[0])
                    .forEach((e) => {
                        this._offsets.push(e[0]), this._targets.push(e[1]);
                    });
            }
            dispose() {
                v.off(this._scrollElement, ri), super.dispose();
            }
            _getConfig(e) {
                return (
                    ((e = {
                        ...si,
                        ...r.getDataAttributes(this._element),
                        ...("object" == typeof e && e ? e : {}),
                    }).target = o(e.target) || document.documentElement),
                    f(oi, e, ai),
                    e
                );
            }
            _getScrollTop() {
                return this._scrollElement === window
                    ? this._scrollElement.pageYOffset
                    : this._scrollElement.scrollTop;
            }
            _getScrollHeight() {
                return (
                    this._scrollElement.scrollHeight ||
                    Math.max(
                        document.body.scrollHeight,
                        document.documentElement.scrollHeight
                    )
                );
            }
            _getOffsetHeight() {
                return this._scrollElement === window
                    ? window.innerHeight
                    : this._scrollElement.getBoundingClientRect().height;
            }
            _process() {
                var t = this._getScrollTop() + this._config.offset,
                    e = this._getScrollHeight(),
                    n = this._config.offset + e - this._getOffsetHeight();
                if ((this._scrollHeight !== e && this.refresh(), n <= t))
                    return (
                        (e = this._targets[this._targets.length - 1]),
                        void (this._activeTarget !== e && this._activate(e))
                    );
                if (
                    this._activeTarget &&
                    t < this._offsets[0] &&
                    0 < this._offsets[0]
                )
                    return (this._activeTarget = null), void this._clear();
                for (let e = this._offsets.length; e--; )
                    this._activeTarget !== this._targets[e] &&
                        t >= this._offsets[e] &&
                        (void 0 === this._offsets[e + 1] ||
                            t < this._offsets[e + 1]) &&
                        this._activate(this._targets[e]);
            }
            _activate(t) {
                (this._activeTarget = t), this._clear();
                const e = di
                        .split(",")
                        .map(
                            (e) =>
                                e + `[data-bs-target="${t}"],${e}[href="${t}"]`
                        ),
                    n = h.findOne(e.join(","), this._config.target);
                n.classList.add(ci),
                    n.classList.contains(li)
                        ? h
                              .findOne(
                                  ".dropdown-toggle",
                                  n.closest(".dropdown")
                              )
                              .classList.add(ci)
                        : h.parents(n, ".nav, .list-group").forEach((e) => {
                              h
                                  .prev(e, ui + ", " + hi)
                                  .forEach((e) => e.classList.add(ci)),
                                  h.prev(e, ".nav-item").forEach((e) => {
                                      h.children(e, ui).forEach((e) =>
                                          e.classList.add(ci)
                                      );
                                  });
                          }),
                    v.trigger(this._scrollElement, "activate.bs.scrollspy", {
                        relatedTarget: t,
                    });
            }
            _clear() {
                h.find(di, this._config.target)
                    .filter((e) => e.classList.contains(ci))
                    .forEach((e) => e.classList.remove(ci));
            }
            static jQueryInterface(t) {
                return this.each(function () {
                    const e = pi.getOrCreateInstance(this, t);
                    if ("string" == typeof t) {
                        if (void 0 === e[t])
                            throw new TypeError(`No method named "${t}"`);
                        e[t]();
                    }
                });
            }
        }
        v.on(window, "load.bs.scrollspy.data-api", () => {
            h.find('[data-bs-spy="scroll"]').forEach((e) => new pi(e));
        }),
            x(pi);
        const gi = "active",
            mi = ".active",
            vi = ":scope > li > .active";
        class yi extends V {
            static get NAME() {
                return "tab";
            }
            show() {
                if (
                    !this._element.parentNode ||
                    this._element.parentNode.nodeType !== Node.ELEMENT_NODE ||
                    !this._element.classList.contains(gi)
                ) {
                    let e;
                    var t = c(this._element),
                        n = this._element.closest(".nav, .list-group"),
                        i =
                            (n &&
                                ((i =
                                    "UL" === n.nodeName || "OL" === n.nodeName
                                        ? vi
                                        : mi),
                                (e = (e = h.find(i, n))[e.length - 1])),
                            e
                                ? v.trigger(e, "hide.bs.tab", {
                                      relatedTarget: this._element,
                                  })
                                : null);
                    v.trigger(this._element, "show.bs.tab", {
                        relatedTarget: e,
                    }).defaultPrevented ||
                        (null !== i && i.defaultPrevented) ||
                        (this._activate(this._element, n),
                        (i = () => {
                            v.trigger(e, "hidden.bs.tab", {
                                relatedTarget: this._element,
                            }),
                                v.trigger(this._element, "shown.bs.tab", {
                                    relatedTarget: e,
                                });
                        }),
                        t ? this._activate(t, t.parentNode, i) : i());
                }
            }
            _activate(e, t, n) {
                const i = (
                    !t || ("UL" !== t.nodeName && "OL" !== t.nodeName)
                        ? h.children(t, mi)
                        : h.find(vi, t)
                )[0];
                var t = n && i && i.classList.contains("fade"),
                    o = () => this._transitionComplete(e, i, n);
                i && t
                    ? (i.classList.remove("show"),
                      this._queueCallback(o, e, !0))
                    : o();
            }
            _transitionComplete(e, t, n) {
                if (t) {
                    t.classList.remove(gi);
                    const o = h.findOne(
                        ":scope > .dropdown-menu .active",
                        t.parentNode
                    );
                    o && o.classList.remove(gi),
                        "tab" === t.getAttribute("role") &&
                            t.setAttribute("aria-selected", !1);
                }
                e.classList.add(gi),
                    "tab" === e.getAttribute("role") &&
                        e.setAttribute("aria-selected", !0),
                    b(e),
                    e.classList.contains("fade") && e.classList.add("show");
                let i = e.parentNode;
                (i = i && "LI" === i.nodeName ? i.parentNode : i) &&
                    i.classList.contains("dropdown-menu") &&
                    ((t = e.closest(".dropdown")) &&
                        h
                            .find(".dropdown-toggle", t)
                            .forEach((e) => e.classList.add(gi)),
                    e.setAttribute("aria-expanded", !0)),
                    n && n();
            }
            static jQueryInterface(t) {
                return this.each(function () {
                    const e = yi.getOrCreateInstance(this);
                    if ("string" == typeof t) {
                        if (void 0 === e[t])
                            throw new TypeError(`No method named "${t}"`);
                        e[t]();
                    }
                });
            }
        }
        v.on(
            document,
            "click.bs.tab.data-api",
            '[data-bs-toggle="tab"], [data-bs-toggle="pill"], [data-bs-toggle="list"]',
            function (e) {
                if (
                    (["A", "AREA"].includes(this.tagName) && e.preventDefault(),
                    !g(this))
                ) {
                    const t = yi.getOrCreateInstance(this);
                    t.show();
                }
            }
        ),
            x(yi);
        const bi = "show",
            _i = "showing",
            wi = { animation: "boolean", autohide: "boolean", delay: "number" },
            xi = { animation: !0, autohide: !0, delay: 5e3 };
        class Ei extends V {
            constructor(e, t) {
                super(e),
                    (this._config = this._getConfig(t)),
                    (this._timeout = null),
                    (this._hasMouseInteraction = !1),
                    (this._hasKeyboardInteraction = !1),
                    this._setListeners();
            }
            static get DefaultType() {
                return wi;
            }
            static get Default() {
                return xi;
            }
            static get NAME() {
                return "toast";
            }
            show() {
                v.trigger(this._element, "show.bs.toast").defaultPrevented ||
                    (this._clearTimeout(),
                    this._config.animation &&
                        this._element.classList.add("fade"),
                    this._element.classList.remove("hide"),
                    b(this._element),
                    this._element.classList.add(bi),
                    this._element.classList.add(_i),
                    this._queueCallback(
                        () => {
                            this._element.classList.remove(_i),
                                v.trigger(this._element, "shown.bs.toast"),
                                this._maybeScheduleHide();
                        },
                        this._element,
                        this._config.animation
                    ));
            }
            hide() {
                this._element.classList.contains(bi) &&
                    (v.trigger(this._element, "hide.bs.toast")
                        .defaultPrevented ||
                        (this._element.classList.add(_i),
                        this._queueCallback(
                            () => {
                                this._element.classList.add("hide"),
                                    this._element.classList.remove(_i),
                                    this._element.classList.remove(bi),
                                    v.trigger(this._element, "hidden.bs.toast");
                            },
                            this._element,
                            this._config.animation
                        )));
            }
            dispose() {
                this._clearTimeout(),
                    this._element.classList.contains(bi) &&
                        this._element.classList.remove(bi),
                    super.dispose();
            }
            _getConfig(e) {
                return (
                    (e = {
                        ...xi,
                        ...r.getDataAttributes(this._element),
                        ...("object" == typeof e && e ? e : {}),
                    }),
                    f("toast", e, this.constructor.DefaultType),
                    e
                );
            }
            _maybeScheduleHide() {
                this._config.autohide &&
                    (this._hasMouseInteraction ||
                        this._hasKeyboardInteraction ||
                        (this._timeout = setTimeout(() => {
                            this.hide();
                        }, this._config.delay)));
            }
            _onInteraction(e, t) {
                switch (e.type) {
                    case "mouseover":
                    case "mouseout":
                        this._hasMouseInteraction = t;
                        break;
                    case "focusin":
                    case "focusout":
                        this._hasKeyboardInteraction = t;
                }
                t
                    ? this._clearTimeout()
                    : ((e = e.relatedTarget),
                      this._element === e ||
                          this._element.contains(e) ||
                          this._maybeScheduleHide());
            }
            _setListeners() {
                v.on(this._element, "mouseover.bs.toast", (e) =>
                    this._onInteraction(e, !0)
                ),
                    v.on(this._element, "mouseout.bs.toast", (e) =>
                        this._onInteraction(e, !1)
                    ),
                    v.on(this._element, "focusin.bs.toast", (e) =>
                        this._onInteraction(e, !0)
                    ),
                    v.on(this._element, "focusout.bs.toast", (e) =>
                        this._onInteraction(e, !1)
                    );
            }
            _clearTimeout() {
                clearTimeout(this._timeout), (this._timeout = null);
            }
            static jQueryInterface(t) {
                return this.each(function () {
                    const e = Ei.getOrCreateInstance(this, t);
                    if ("string" == typeof t) {
                        if (void 0 === e[t])
                            throw new TypeError(`No method named "${t}"`);
                        e[t](this);
                    }
                });
            }
        }
        return (
            Y(Ei),
            x(Ei),
            {
                Alert: Q,
                Button: K,
                Carousel: de,
                Collapse: Ee,
                Dropdown: on,
                Modal: Ln,
                Offcanvas: Pn,
                Popover: ii,
                ScrollSpy: pi,
                Tab: yi,
                Toast: Ei,
                Tooltip: Zn,
            }
        );
    }),
    (function (e) {
        "use strict";
        "object" == typeof exports
            ? (module.exports = e(window.jQuery))
            : "function" == typeof define && define.amd
            ? define(["jquery"], e)
            : window.jQuery &&
              !window.jQuery.fn.colorpicker &&
              e(window.jQuery);
    })(function (a) {
        "use strict";
        function i(e, t) {
            (this.value = { h: 0, s: 0, b: 0, a: 1 }),
                (this.origFormat = null),
                t && a.extend(this.colors, t),
                e &&
                    (void 0 !== e.toLowerCase
                        ? this.setColor((e += ""))
                        : void 0 !== e.h && (this.value = e));
        }
        function r(e, t) {
            var n;
            (this.element = a(e).addClass("colorpicker-element")),
                (this.options = a.extend(!0, {}, o, this.element.data(), t)),
                (this.component = this.options.component),
                (this.component =
                    !1 !== this.component && this.element.find(this.component)),
                this.component &&
                    0 === this.component.length &&
                    (this.component = !1),
                (this.container =
                    !0 === this.options.container
                        ? this.element
                        : this.options.container),
                (this.container = !1 !== this.container && a(this.container)),
                (this.input = this.element.is("input")
                    ? this.element
                    : !!this.options.input &&
                      this.element.find(this.options.input)),
                this.input && 0 === this.input.length && (this.input = !1),
                (this.color = new i(
                    !1 !== this.options.color
                        ? this.options.color
                        : this.getValue(),
                    this.options.colorSelectors
                )),
                (this.format =
                    !1 !== this.options.format
                        ? this.options.format
                        : this.color.origFormat),
                !1 !== this.options.color &&
                    (this.updateInput(this.color), this.updateData(this.color)),
                (this.picker = a(this.options.template)),
                this.options.customClass &&
                    this.picker.addClass(this.options.customClass),
                this.options.inline
                    ? this.picker.addClass(
                          "colorpicker-inline colorpicker-visible"
                      )
                    : this.picker.addClass("colorpicker-hidden"),
                this.options.horizontal &&
                    this.picker.addClass("colorpicker-horizontal"),
                ("rgba" !== this.format &&
                    "hsla" !== this.format &&
                    !1 !== this.options.format) ||
                    this.picker.addClass("colorpicker-with-alpha"),
                "right" === this.options.align &&
                    this.picker.addClass("colorpicker-right"),
                !0 === this.options.inline &&
                    this.picker.addClass("colorpicker-no-arrow"),
                this.options.colorSelectors &&
                    (a.each((n = this).options.colorSelectors, function (e, t) {
                        t = a("<i />")
                            .css("background-color", t)
                            .data("class", e);
                        t.click(function () {
                            n.setValue(a(this).css("background-color"));
                        }),
                            n.picker.find(".colorpicker-selectors").append(t);
                    }),
                    this.picker.find(".colorpicker-selectors").show()),
                this.picker.on(
                    "mousedown.colorpicker touchstart.colorpicker",
                    a.proxy(this.mousedown, this)
                ),
                this.picker.appendTo(this.container || a("body")),
                !1 !== this.input &&
                    (this.input.on({
                        "keyup.colorpicker": a.proxy(this.keyup, this),
                    }),
                    this.input.on({
                        "change.colorpicker": a.proxy(this.change, this),
                    }),
                    !1 === this.component &&
                        this.element.on({
                            "focus.colorpicker": a.proxy(this.show, this),
                        }),
                    !1 === this.options.inline &&
                        this.element.on({
                            "focusout.colorpicker": a.proxy(this.hide, this),
                        })),
                !1 !== this.component &&
                    this.component.on({
                        "click.colorpicker": a.proxy(this.show, this),
                    }),
                !1 === this.input &&
                    !1 === this.component &&
                    this.element.on({
                        "click.colorpicker": a.proxy(this.show, this),
                    }),
                !1 !== this.input &&
                    !1 !== this.component &&
                    "color" === this.input.attr("type") &&
                    this.input.on({
                        "click.colorpicker": a.proxy(this.show, this),
                        "focus.colorpicker": a.proxy(this.show, this),
                    }),
                this.update(),
                a(
                    a.proxy(function () {
                        this.element.trigger("create");
                    }, this)
                );
        }
        var o = {
            horizontal: !(i.prototype = {
                constructor: i,
                colors: {
                    aliceblue: "#f0f8ff",
                    antiquewhite: "#faebd7",
                    aqua: "#00ffff",
                    aquamarine: "#7fffd4",
                    azure: "#f0ffff",
                    beige: "#f5f5dc",
                    bisque: "#ffe4c4",
                    black: "#000000",
                    blanchedalmond: "#ffebcd",
                    blue: "#0000ff",
                    blueviolet: "#8a2be2",
                    brown: "#a52a2a",
                    burlywood: "#deb887",
                    cadetblue: "#5f9ea0",
                    chartreuse: "#7fff00",
                    chocolate: "#d2691e",
                    coral: "#ff7f50",
                    cornflowerblue: "#6495ed",
                    cornsilk: "#fff8dc",
                    crimson: "#dc143c",
                    cyan: "#00ffff",
                    darkblue: "#00008b",
                    darkcyan: "#008b8b",
                    darkgoldenrod: "#b8860b",
                    darkgray: "#a9a9a9",
                    darkgreen: "#006400",
                    darkkhaki: "#bdb76b",
                    darkmagenta: "#8b008b",
                    darkolivegreen: "#556b2f",
                    darkorange: "#ff8c00",
                    darkorchid: "#9932cc",
                    darkred: "#8b0000",
                    darksalmon: "#e9967a",
                    darkseagreen: "#8fbc8f",
                    darkslateblue: "#483d8b",
                    darkslategray: "#2f4f4f",
                    darkturquoise: "#00ced1",
                    darkviolet: "#9400d3",
                    deeppink: "#ff1493",
                    deepskyblue: "#00bfff",
                    dimgray: "#696969",
                    dodgerblue: "#1e90ff",
                    firebrick: "#b22222",
                    floralwhite: "#fffaf0",
                    forestgreen: "#228b22",
                    fuchsia: "#ff00ff",
                    gainsboro: "#dcdcdc",
                    ghostwhite: "#f8f8ff",
                    gold: "#ffd700",
                    goldenrod: "#daa520",
                    gray: "#808080",
                    green: "#008000",
                    greenyellow: "#adff2f",
                    honeydew: "#f0fff0",
                    hotpink: "#ff69b4",
                    indianred: "#cd5c5c",
                    indigo: "#4b0082",
                    ivory: "#fffff0",
                    khaki: "#f0e68c",
                    lavender: "#e6e6fa",
                    lavenderblush: "#fff0f5",
                    lawngreen: "#7cfc00",
                    lemonchiffon: "#fffacd",
                    lightblue: "#add8e6",
                    lightcoral: "#f08080",
                    lightcyan: "#e0ffff",
                    lightgoldenrodyellow: "#fafad2",
                    lightgrey: "#d3d3d3",
                    lightgreen: "#90ee90",
                    lightpink: "#ffb6c1",
                    lightsalmon: "#ffa07a",
                    lightseagreen: "#20b2aa",
                    lightskyblue: "#87cefa",
                    lightslategray: "#778899",
                    lightsteelblue: "#b0c4de",
                    lightyellow: "#ffffe0",
                    lime: "#00ff00",
                    limegreen: "#32cd32",
                    linen: "#faf0e6",
                    magenta: "#ff00ff",
                    maroon: "#800000",
                    mediumaquamarine: "#66cdaa",
                    mediumblue: "#0000cd",
                    mediumorchid: "#ba55d3",
                    mediumpurple: "#9370d8",
                    mediumseagreen: "#3cb371",
                    mediumslateblue: "#7b68ee",
                    mediumspringgreen: "#00fa9a",
                    mediumturquoise: "#48d1cc",
                    mediumvioletred: "#c71585",
                    midnightblue: "#191970",
                    mintcream: "#f5fffa",
                    mistyrose: "#ffe4e1",
                    moccasin: "#ffe4b5",
                    navajowhite: "#ffdead",
                    navy: "#000080",
                    oldlace: "#fdf5e6",
                    olive: "#808000",
                    olivedrab: "#6b8e23",
                    orange: "#ffa500",
                    orangered: "#ff4500",
                    orchid: "#da70d6",
                    palegoldenrod: "#eee8aa",
                    palegreen: "#98fb98",
                    paleturquoise: "#afeeee",
                    palevioletred: "#d87093",
                    papayawhip: "#ffefd5",
                    peachpuff: "#ffdab9",
                    peru: "#cd853f",
                    pink: "#ffc0cb",
                    plum: "#dda0dd",
                    powderblue: "#b0e0e6",
                    purple: "#800080",
                    red: "#ff0000",
                    rosybrown: "#bc8f8f",
                    royalblue: "#4169e1",
                    saddlebrown: "#8b4513",
                    salmon: "#fa8072",
                    sandybrown: "#f4a460",
                    seagreen: "#2e8b57",
                    seashell: "#fff5ee",
                    sienna: "#a0522d",
                    silver: "#c0c0c0",
                    skyblue: "#87ceeb",
                    slateblue: "#6a5acd",
                    slategray: "#708090",
                    snow: "#fffafa",
                    springgreen: "#00ff7f",
                    steelblue: "#4682b4",
                    tan: "#d2b48c",
                    teal: "#008080",
                    thistle: "#d8bfd8",
                    tomato: "#ff6347",
                    turquoise: "#40e0d0",
                    violet: "#ee82ee",
                    wheat: "#f5deb3",
                    white: "#ffffff",
                    whitesmoke: "#f5f5f5",
                    yellow: "#ffff00",
                    yellowgreen: "#9acd32",
                    transparent: "transparent",
                },
                _sanitizeNumber: function (e) {
                    return "number" == typeof e
                        ? e
                        : isNaN(e) || null === e || "" === e || void 0 === e
                        ? 1
                        : "" === e
                        ? 0
                        : void 0 !== e.toLowerCase
                        ? (e.match(/^\./) && (e = "0" + e),
                          Math.ceil(100 * parseFloat(e)) / 100)
                        : 1;
                },
                isTransparent: function (e) {
                    return (
                        !!e &&
                        ("transparent" === (e = e.toLowerCase().trim()) ||
                            e.match(/#?00000000/) ||
                            e.match(/(rgba|hsla)\(0,0,0,0?\.?0\)/))
                    );
                },
                rgbaIsTransparent: function (e) {
                    return 0 === e.r && 0 === e.g && 0 === e.b && 0 === e.a;
                },
                setColor: function (e) {
                    (e = e.toLowerCase().trim()) &&
                        (this.isTransparent(e)
                            ? (this.value = { h: 0, s: 0, b: 0, a: 0 })
                            : (this.value = this.stringToHSB(e) || {
                                  h: 0,
                                  s: 0,
                                  b: 0,
                                  a: 1,
                              }));
                },
                stringToHSB: function (i) {
                    (i = i.toLowerCase()),
                        void 0 !== this.colors[i] &&
                            ((i = this.colors[i]), (o = "alias"));
                    var o,
                        r = this,
                        s = !1;
                    return (
                        a.each(this.stringParsers, function (e, t) {
                            var n = t.re.exec(i),
                                n = n && t.parse.apply(r, [n]),
                                t = o || t.format || "rgba";
                            return (
                                !n ||
                                ((s = t.match(/hsla?/)
                                    ? r.RGBtoHSB.apply(
                                          r,
                                          r.HSLtoRGB.apply(r, n)
                                      )
                                    : r.RGBtoHSB.apply(r, n)),
                                (r.origFormat = t),
                                !1)
                            );
                        }),
                        s
                    );
                },
                setHue: function (e) {
                    this.value.h = 1 - e;
                },
                setSaturation: function (e) {
                    this.value.s = e;
                },
                setBrightness: function (e) {
                    this.value.b = 1 - e;
                },
                setAlpha: function (e) {
                    this.value.a =
                        Math.round((parseInt(100 * (1 - e), 10) / 100) * 100) /
                        100;
                },
                toRGB: function (e, t, n, i) {
                    var o, r, s;
                    return (
                        e ||
                            ((e = this.value.h),
                            (t = this.value.s),
                            (n = this.value.b)),
                        (e = ((e *= 360) % 360) / 60),
                        (o = r = t = n - (n = n * t)),
                        (o += [
                            n,
                            (s = n * (1 - Math.abs((e % 2) - 1))),
                            0,
                            0,
                            s,
                            n,
                        ][(e = ~~e)]),
                        (r += [s, n, n, s, 0, 0][e]),
                        (t += [0, 0, s, n, n, s][e]),
                        {
                            r: Math.round(255 * o),
                            g: Math.round(255 * r),
                            b: Math.round(255 * t),
                            a: i || this.value.a,
                        }
                    );
                },
                toHex: function (e, t, n, i) {
                    e = this.toRGB(e, t, n, i);
                    return this.rgbaIsTransparent(e)
                        ? "transparent"
                        : "#" +
                              (
                                  (1 << 24) |
                                  (parseInt(e.r) << 16) |
                                  (parseInt(e.g) << 8) |
                                  parseInt(e.b)
                              )
                                  .toString(16)
                                  .substr(1);
                },
                toHSL: function (e, t, n, i) {
                    (e = e || this.value.h),
                        (t = t || this.value.s),
                        (n = n || this.value.b),
                        (i = i || this.value.a);
                    var o = (2 - t) * n,
                        t = t * n;
                    return (
                        (t /= 0 < o && o <= 1 ? o : 2 - o),
                        (o /= 2),
                        1 < t && (t = 1),
                        {
                            h: isNaN(e) ? 0 : e,
                            s: isNaN(t) ? 0 : t,
                            l: isNaN(o) ? 0 : o,
                            a: isNaN(i) ? 0 : i,
                        }
                    );
                },
                toAlias: function (e, t, n, i) {
                    var o,
                        r = this.toHex(e, t, n, i);
                    for (o in this.colors) if (this.colors[o] === r) return o;
                    return !1;
                },
                RGBtoHSB: function (e, t, n, i) {
                    var o, r, s;
                    return (
                        (e /= 255),
                        (t /= 255),
                        (n /= 255),
                        (o =
                            0 ==
                            (s = (r = Math.max(e, t, n)) - Math.min(e, t, n))
                                ? 0
                                : s / r),
                        {
                            h: this._sanitizeNumber(
                                ((((0 == s
                                    ? null
                                    : r === e
                                    ? (t - n) / s
                                    : r === t
                                    ? (n - e) / s + 2
                                    : (e - t) / s + 4) +
                                    360) %
                                    6) *
                                    60) /
                                    360
                            ),
                            s: o,
                            b: r,
                            a: this._sanitizeNumber(i),
                        }
                    );
                },
                HueToRGB: function (e, t, n) {
                    return (
                        n < 0 ? (n += 1) : 1 < n && --n,
                        6 * n < 1
                            ? e + (t - e) * n * 6
                            : 2 * n < 1
                            ? t
                            : 3 * n < 2
                            ? e + (t - e) * (2 / 3 - n) * 6
                            : e
                    );
                },
                HSLtoRGB: function (e, t, n, i) {
                    t < 0 && (t = 0);
                    var t =
                            2 * n -
                            (n = n <= 0.5 ? n * (1 + t) : n + t - n * t),
                        o = e,
                        r = e - 1 / 3;
                    return [
                        Math.round(255 * this.HueToRGB(t, n, e + 1 / 3)),
                        Math.round(255 * this.HueToRGB(t, n, o)),
                        Math.round(255 * this.HueToRGB(t, n, r)),
                        this._sanitizeNumber(i),
                    ];
                },
                toString: function (e) {
                    var t = !1;
                    switch ((e = e || "rgba")) {
                        case "rgb":
                            return (
                                (t = this.toRGB()),
                                this.rgbaIsTransparent(t)
                                    ? "transparent"
                                    : "rgb(" + t.r + "," + t.g + "," + t.b + ")"
                            );
                        case "rgba":
                            return (
                                "rgba(" +
                                (t = this.toRGB()).r +
                                "," +
                                t.g +
                                "," +
                                t.b +
                                "," +
                                t.a +
                                ")"
                            );
                        case "hsl":
                            return (
                                (t = this.toHSL()),
                                "hsl(" +
                                    Math.round(360 * t.h) +
                                    "," +
                                    Math.round(100 * t.s) +
                                    "%," +
                                    Math.round(100 * t.l) +
                                    "%)"
                            );
                        case "hsla":
                            return (
                                (t = this.toHSL()),
                                "hsla(" +
                                    Math.round(360 * t.h) +
                                    "," +
                                    Math.round(100 * t.s) +
                                    "%," +
                                    Math.round(100 * t.l) +
                                    "%," +
                                    t.a +
                                    ")"
                            );
                        case "hex":
                            return this.toHex();
                        case "alias":
                            return this.toAlias() || this.toHex();
                        default:
                            return t;
                    }
                },
                stringParsers: [
                    {
                        re: /rgb\(\s*(\d{1,3})\s*,\s*(\d{1,3})\s*,\s*(\d{1,3})\s*?\)/,
                        format: "rgb",
                        parse: function (e) {
                            return [e[1], e[2], e[3], 1];
                        },
                    },
                    {
                        re: /rgb\(\s*(\d*(?:\.\d+)?)\%\s*,\s*(\d*(?:\.\d+)?)\%\s*,\s*(\d*(?:\.\d+)?)\%\s*?\)/,
                        format: "rgb",
                        parse: function (e) {
                            return [2.55 * e[1], 2.55 * e[2], 2.55 * e[3], 1];
                        },
                    },
                    {
                        re: /rgba\(\s*(\d{1,3})\s*,\s*(\d{1,3})\s*,\s*(\d{1,3})\s*(?:,\s*(\d*(?:\.\d+)?)\s*)?\)/,
                        format: "rgba",
                        parse: function (e) {
                            return [e[1], e[2], e[3], e[4]];
                        },
                    },
                    {
                        re: /rgba\(\s*(\d*(?:\.\d+)?)\%\s*,\s*(\d*(?:\.\d+)?)\%\s*,\s*(\d*(?:\.\d+)?)\%\s*(?:,\s*(\d*(?:\.\d+)?)\s*)?\)/,
                        format: "rgba",
                        parse: function (e) {
                            return [
                                2.55 * e[1],
                                2.55 * e[2],
                                2.55 * e[3],
                                e[4],
                            ];
                        },
                    },
                    {
                        re: /hsl\(\s*(\d*(?:\.\d+)?)\s*,\s*(\d*(?:\.\d+)?)\%\s*,\s*(\d*(?:\.\d+)?)\%\s*?\)/,
                        format: "hsl",
                        parse: function (e) {
                            return [e[1] / 360, e[2] / 100, e[3] / 100, e[4]];
                        },
                    },
                    {
                        re: /hsla\(\s*(\d*(?:\.\d+)?)\s*,\s*(\d*(?:\.\d+)?)\%\s*,\s*(\d*(?:\.\d+)?)\%\s*(?:,\s*(\d*(?:\.\d+)?)\s*)?\)/,
                        format: "hsla",
                        parse: function (e) {
                            return [e[1] / 360, e[2] / 100, e[3] / 100, e[4]];
                        },
                    },
                    {
                        re: /#?([a-fA-F0-9]{2})([a-fA-F0-9]{2})([a-fA-F0-9]{2})/,
                        format: "hex",
                        parse: function (e) {
                            return [
                                parseInt(e[1], 16),
                                parseInt(e[2], 16),
                                parseInt(e[3], 16),
                                1,
                            ];
                        },
                    },
                    {
                        re: /#?([a-fA-F0-9])([a-fA-F0-9])([a-fA-F0-9])/,
                        format: "hex",
                        parse: function (e) {
                            return [
                                parseInt(e[1] + e[1], 16),
                                parseInt(e[2] + e[2], 16),
                                parseInt(e[3] + e[3], 16),
                                1,
                            ];
                        },
                    },
                ],
                colorNameToHex: function (e) {
                    return (
                        void 0 !== this.colors[e.toLowerCase()] &&
                        this.colors[e.toLowerCase()]
                    );
                },
            }),
            inline: !1,
            color: !1,
            format: !1,
            input: "input",
            container: !1,
            component: ".add-on, .input-group-addon",
            sliders: {
                saturation: {
                    maxLeft: 100,
                    maxTop: 100,
                    callLeft: "setSaturation",
                    callTop: "setBrightness",
                },
                hue: {
                    maxLeft: 0,
                    maxTop: 100,
                    callLeft: !1,
                    callTop: "setHue",
                },
                alpha: {
                    maxLeft: 0,
                    maxTop: 100,
                    callLeft: !1,
                    callTop: "setAlpha",
                },
            },
            slidersHorz: {
                saturation: {
                    maxLeft: 100,
                    maxTop: 100,
                    callLeft: "setSaturation",
                    callTop: "setBrightness",
                },
                hue: {
                    maxLeft: 100,
                    maxTop: 0,
                    callLeft: "setHue",
                    callTop: !1,
                },
                alpha: {
                    maxLeft: 100,
                    maxTop: 0,
                    callLeft: "setAlpha",
                    callTop: !1,
                },
            },
            template:
                '<div class="colorpicker dropdown-menu"><div class="colorpicker-saturation"><i><b></b></i></div><div class="colorpicker-hue"><i></i></div><div class="colorpicker-alpha"><i></i></div><div class="colorpicker-color"><div /></div><div class="colorpicker-selectors"></div></div>',
            align: "right",
            customClass: null,
            colorSelectors: null,
        };
        (r.Color = i),
            (r.prototype = {
                constructor: r,
                destroy: function () {
                    this.picker.remove(),
                        this.element
                            .removeData("colorpicker", "color")
                            .off(".colorpicker"),
                        !1 !== this.input && this.input.off(".colorpicker"),
                        !1 !== this.component &&
                            this.component.off(".colorpicker"),
                        this.element.removeClass("colorpicker-element"),
                        this.element.trigger({ type: "destroy" });
                },
                reposition: function () {
                    if (!1 !== this.options.inline || this.options.container)
                        return !1;
                    var e =
                            this.container &&
                            this.container[0] !== document.body
                                ? "position"
                                : "offset",
                        t = this.component || this.element,
                        e = t[e]();
                    "right" === this.options.align &&
                        (e.left -= this.picker.outerWidth() - t.outerWidth()),
                        this.picker.css({
                            top: e.top + t.outerHeight(),
                            left: e.left,
                        });
                },
                show: function (e) {
                    if (this.isDisabled()) return !1;
                    this.picker
                        .addClass("colorpicker-visible")
                        .removeClass("colorpicker-hidden"),
                        this.reposition(),
                        a(window).on(
                            "resize.colorpicker",
                            a.proxy(this.reposition, this)
                        ),
                        !e ||
                            (this.hasInput() &&
                                "color" !== this.input.attr("type")) ||
                            (e.stopPropagation &&
                                e.preventDefault &&
                                (e.stopPropagation(), e.preventDefault())),
                        (!this.component && this.input) ||
                            !1 !== this.options.inline ||
                            a(window.document).on({
                                "mousedown.colorpicker": a.proxy(
                                    this.hide,
                                    this
                                ),
                            }),
                        this.element.trigger({
                            type: "showPicker",
                            color: this.color,
                        });
                },
                hide: function () {
                    this.picker
                        .addClass("colorpicker-hidden")
                        .removeClass("colorpicker-visible"),
                        a(window).off("resize.colorpicker", this.reposition),
                        a(document).off({ "mousedown.colorpicker": this.hide }),
                        this.update(),
                        this.element.trigger({
                            type: "hidePicker",
                            color: this.color,
                        });
                },
                updateData: function (e) {
                    return (
                        (e = e || this.color.toString(this.format)),
                        this.element.data("color", e),
                        e
                    );
                },
                updateInput: function (e) {
                    var t;
                    return (
                        (e = e || this.color.toString(this.format)),
                        !1 !== this.input &&
                            (this.options.colorSelectors &&
                                ((t = new i(
                                    e,
                                    this.options.colorSelectors
                                ).toAlias()),
                                void 0 !== this.options.colorSelectors[t] &&
                                    (e = t)),
                            this.input.prop("value", e)),
                        e
                    );
                },
                updatePicker: function (e) {
                    void 0 !== e &&
                        (this.color = new i(e, this.options.colorSelectors));
                    var t =
                            !1 === this.options.horizontal
                                ? this.options.sliders
                                : this.options.slidersHorz,
                        n = this.picker.find("i");
                    if (0 !== n.length)
                        return (
                            !1 === this.options.horizontal
                                ? ((t = this.options.sliders),
                                  n
                                      .eq(1)
                                      .css(
                                          "top",
                                          t.hue.maxTop *
                                              (1 - this.color.value.h)
                                      )
                                      .end()
                                      .eq(2)
                                      .css(
                                          "top",
                                          t.alpha.maxTop *
                                              (1 - this.color.value.a)
                                      ))
                                : ((t = this.options.slidersHorz),
                                  n
                                      .eq(1)
                                      .css(
                                          "left",
                                          t.hue.maxLeft *
                                              (1 - this.color.value.h)
                                      )
                                      .end()
                                      .eq(2)
                                      .css(
                                          "left",
                                          t.alpha.maxLeft *
                                              (1 - this.color.value.a)
                                      )),
                            n
                                .eq(0)
                                .css({
                                    top:
                                        t.saturation.maxTop -
                                        this.color.value.b *
                                            t.saturation.maxTop,
                                    left:
                                        this.color.value.s *
                                        t.saturation.maxLeft,
                                }),
                            this.picker
                                .find(".colorpicker-saturation")
                                .css(
                                    "backgroundColor",
                                    this.color.toHex(
                                        this.color.value.h,
                                        1,
                                        1,
                                        1
                                    )
                                ),
                            this.picker
                                .find(".colorpicker-alpha")
                                .css("backgroundColor", this.color.toHex()),
                            this.picker
                                .find(
                                    ".colorpicker-color, .colorpicker-color div"
                                )
                                .css(
                                    "backgroundColor",
                                    this.color.toString(this.format)
                                ),
                            e
                        );
                },
                updateComponent: function (e) {
                    var t;
                    return (
                        (e = e || this.color.toString(this.format)),
                        !1 !== this.component &&
                            (0 < (t = this.component.find("i").eq(0)).length
                                ? t
                                : this.component
                            ).css({ backgroundColor: e }),
                        e
                    );
                },
                update: function (e) {
                    var t;
                    return (
                        (!1 === this.getValue(!1) && !0 !== e) ||
                            ((t = this.updateComponent()),
                            this.updateInput(t),
                            this.updateData(t),
                            this.updatePicker()),
                        t
                    );
                },
                setValue: function (e) {
                    (this.color = new i(e, this.options.colorSelectors)),
                        this.update(!0),
                        this.element.trigger({
                            type: "changeColor",
                            color: this.color,
                            value: e,
                        });
                },
                getValue: function (e) {
                    var t;
                    return (
                        (e = void 0 === e ? "#000000" : e),
                        (t =
                            void 0 !==
                                (t = this.hasInput()
                                    ? this.input.val()
                                    : this.element.data("color")) &&
                            "" !== t &&
                            null !== t
                                ? t
                                : e)
                    );
                },
                hasInput: function () {
                    return !1 !== this.input;
                },
                isDisabled: function () {
                    return (
                        !!this.hasInput() && !0 === this.input.prop("disabled")
                    );
                },
                disable: function () {
                    return (
                        !!this.hasInput() &&
                        (this.input.prop("disabled", !0),
                        this.element.trigger({
                            type: "disable",
                            color: this.color,
                            value: this.getValue(),
                        }),
                        !0)
                    );
                },
                enable: function () {
                    return (
                        !!this.hasInput() &&
                        (this.input.prop("disabled", !1),
                        this.element.trigger({
                            type: "enable",
                            color: this.color,
                            value: this.getValue(),
                        }),
                        !0)
                    );
                },
                currentSlider: null,
                mousePointer: { left: 0, top: 0 },
                mousedown: function (e) {
                    !e.pageX &&
                        !e.pageY &&
                        e.originalEvent &&
                        e.originalEvent.touches &&
                        ((e.pageX = e.originalEvent.touches[0].pageX),
                        (e.pageY = e.originalEvent.touches[0].pageY)),
                        e.stopPropagation(),
                        e.preventDefault();
                    var t = a(e.target).closest("div"),
                        n = this.options.horizontal
                            ? this.options.slidersHorz
                            : this.options.sliders;
                    if (!t.is(".colorpicker")) {
                        if (t.is(".colorpicker-saturation"))
                            this.currentSlider = a.extend({}, n.saturation);
                        else if (t.is(".colorpicker-hue"))
                            this.currentSlider = a.extend({}, n.hue);
                        else {
                            if (!t.is(".colorpicker-alpha")) return !1;
                            this.currentSlider = a.extend({}, n.alpha);
                        }
                        n = t.offset();
                        (this.currentSlider.guide = t.find("i")[0].style),
                            (this.currentSlider.left = e.pageX - n.left),
                            (this.currentSlider.top = e.pageY - n.top),
                            (this.mousePointer = {
                                left: e.pageX,
                                top: e.pageY,
                            }),
                            a(document)
                                .on({
                                    "mousemove.colorpicker": a.proxy(
                                        this.mousemove,
                                        this
                                    ),
                                    "touchmove.colorpicker": a.proxy(
                                        this.mousemove,
                                        this
                                    ),
                                    "mouseup.colorpicker": a.proxy(
                                        this.mouseup,
                                        this
                                    ),
                                    "touchend.colorpicker": a.proxy(
                                        this.mouseup,
                                        this
                                    ),
                                })
                                .trigger("mousemove");
                    }
                    return !1;
                },
                mousemove: function (e) {
                    !e.pageX &&
                        !e.pageY &&
                        e.originalEvent &&
                        e.originalEvent.touches &&
                        ((e.pageX = e.originalEvent.touches[0].pageX),
                        (e.pageY = e.originalEvent.touches[0].pageY)),
                        e.stopPropagation(),
                        e.preventDefault();
                    var t = Math.max(
                            0,
                            Math.min(
                                this.currentSlider.maxLeft,
                                this.currentSlider.left +
                                    ((e.pageX || this.mousePointer.left) -
                                        this.mousePointer.left)
                            )
                        ),
                        e = Math.max(
                            0,
                            Math.min(
                                this.currentSlider.maxTop,
                                this.currentSlider.top +
                                    ((e.pageY || this.mousePointer.top) -
                                        this.mousePointer.top)
                            )
                        );
                    return (
                        (this.currentSlider.guide.left = t + "px"),
                        (this.currentSlider.guide.top = e + "px"),
                        this.currentSlider.callLeft &&
                            this.color[this.currentSlider.callLeft].call(
                                this.color,
                                t / this.currentSlider.maxLeft
                            ),
                        this.currentSlider.callTop &&
                            this.color[this.currentSlider.callTop].call(
                                this.color,
                                e / this.currentSlider.maxTop
                            ),
                        "setAlpha" === this.currentSlider.callTop &&
                            !1 === this.options.format &&
                            (1 !== this.color.value.a
                                ? ((this.format = "rgba"),
                                  (this.color.origFormat = "rgba"))
                                : ((this.format = "hex"),
                                  (this.color.origFormat = "hex"))),
                        this.update(!0),
                        this.element.trigger({
                            type: "changeColor",
                            color: this.color,
                        }),
                        !1
                    );
                },
                mouseup: function (e) {
                    return (
                        e.stopPropagation(),
                        e.preventDefault(),
                        a(document).off({
                            "mousemove.colorpicker": this.mousemove,
                            "touchmove.colorpicker": this.mousemove,
                            "mouseup.colorpicker": this.mouseup,
                            "touchend.colorpicker": this.mouseup,
                        }),
                        !1
                    );
                },
                change: function (e) {
                    this.keyup(e);
                },
                keyup: function (e) {
                    38 === e.keyCode
                        ? (this.color.value.a < 1 &&
                              (this.color.value.a =
                                  Math.round(
                                      100 * (this.color.value.a + 0.01)
                                  ) / 100),
                          this.update(!0))
                        : 40 === e.keyCode
                        ? (0 < this.color.value.a &&
                              (this.color.value.a =
                                  Math.round(
                                      100 * (this.color.value.a - 0.01)
                                  ) / 100),
                          this.update(!0))
                        : ((this.color = new i(
                              this.input.val(),
                              this.options.colorSelectors
                          )),
                          this.color.origFormat &&
                              !1 === this.options.format &&
                              (this.format = this.color.origFormat),
                          !1 !== this.getValue(!1) &&
                              (this.updateData(),
                              this.updateComponent(),
                              this.updatePicker())),
                        this.element.trigger({
                            type: "changeColor",
                            color: this.color,
                            value: this.input.val(),
                        });
                },
            }),
            (a.colorpicker = r),
            (a.fn.colorpicker = function (n) {
                var i = Array.prototype.slice.call(arguments, 1),
                    e = 1 === this.length,
                    o = null,
                    t = this.each(function () {
                        var e = a(this),
                            t = e.data("colorpicker");
                        t ||
                            ((t = new r(this, "object" == typeof n ? n : {})),
                            e.data("colorpicker", t)),
                            (o =
                                "string" == typeof n
                                    ? a.isFunction(t[n])
                                        ? t[n].apply(t, i)
                                        : (i.length && (t[n] = i[0]), t[n])
                                    : e);
                    });
                return e ? o : t;
            }),
            (a.fn.colorpicker.constructor = r);
    });
