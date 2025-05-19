import __vite__cjsImport0_react_jsxDevRuntime from "/node_modules/.vite/deps/react_jsx-dev-runtime.js?v=565967e7"; const jsxDEV = __vite__cjsImport0_react_jsxDevRuntime["jsxDEV"];
import __vite__cjsImport1_react from "/node_modules/.vite/deps/react.js?v=565967e7"; const React = __vite__cjsImport1_react.__esModule ? __vite__cjsImport1_react.default : __vite__cjsImport1_react;
import __vite__cjsImport2_reactDom_client from "/node_modules/.vite/deps/react-dom_client.js?v=565967e7"; const ReactDOM = __vite__cjsImport2_reactDom_client.__esModule ? __vite__cjsImport2_reactDom_client.default : __vite__cjsImport2_reactDom_client;
import {
  createBrowserRouter,
  RouterProvider
} from "/node_modules/.vite/deps/react-router-dom.js?v=565967e7";
import "/src/index.css";
import App from "/src/App.jsx";
import Root from "/src/routes/root.tsx?t=1710168149147";
import ErrorPage from "/src/error-page.jsx";
import Login from "/src/Login.tsx";
import ChangePassword from "/src/ChangePassword.tsx";
import AccountType from "/src/AccountType.tsx";
import VerifyEmail from "/src/VerifyEmail.tsx";
import Success from "/src/Success.tsx";
import SignUp from "/src/SignUp.tsx";
import ForgotPassword from "/src/ForgotPassword.tsx";
import ResetPassword from "/src/ResetPassword.tsx";
import Courses from "/src/Courses.tsx";
import { ChakraProvider } from "/node_modules/.vite/deps/@chakra-ui_react.js?v=565967e7";
import { ToastContainer, toast } from "/node_modules/.vite/deps/react-toastify.js?v=565967e7";
import "/node_modules/react-toastify/dist/ReactToastify.css";
const router = createBrowserRouter(
  [
    {
      path: "/",
      element: /* @__PURE__ */ jsxDEV(App, {}, void 0, false, {
        fileName: "/Users/yoyo/Downloads/PROSECare/src/main.jsx",
        lineNumber: 28,
        columnNumber: 12
      }, this),
      errorElement: /* @__PURE__ */ jsxDEV(ErrorPage, {}, void 0, false, {
        fileName: "/Users/yoyo/Downloads/PROSECare/src/main.jsx",
        lineNumber: 29,
        columnNumber: 17
      }, this)
    },
    {
      path: "/Dashboard/:sectionId",
      element: /* @__PURE__ */ jsxDEV(Root, {}, void 0, false, {
        fileName: "/Users/yoyo/Downloads/PROSECare/src/main.jsx",
        lineNumber: 33,
        columnNumber: 12
      }, this)
    },
    {
      path: "/Login",
      element: /* @__PURE__ */ jsxDEV(Login, {}, void 0, false, {
        fileName: "/Users/yoyo/Downloads/PROSECare/src/main.jsx",
        lineNumber: 37,
        columnNumber: 12
      }, this)
    },
    {
      path: "/ChangePassword",
      element: /* @__PURE__ */ jsxDEV(ChangePassword, {}, void 0, false, {
        fileName: "/Users/yoyo/Downloads/PROSECare/src/main.jsx",
        lineNumber: 41,
        columnNumber: 12
      }, this)
    },
    {
      path: "/SignUp",
      element: /* @__PURE__ */ jsxDEV(SignUp, {}, void 0, false, {
        fileName: "/Users/yoyo/Downloads/PROSECare/src/main.jsx",
        lineNumber: 45,
        columnNumber: 12
      }, this)
    },
    {
      path: "/AccountType",
      element: /* @__PURE__ */ jsxDEV(AccountType, {}, void 0, false, {
        fileName: "/Users/yoyo/Downloads/PROSECare/src/main.jsx",
        lineNumber: 49,
        columnNumber: 12
      }, this)
    },
    {
      path: "/VerifyEmail",
      element: /* @__PURE__ */ jsxDEV(VerifyEmail, {}, void 0, false, {
        fileName: "/Users/yoyo/Downloads/PROSECare/src/main.jsx",
        lineNumber: 53,
        columnNumber: 12
      }, this)
    },
    {
      path: "/ForgotPassword",
      element: /* @__PURE__ */ jsxDEV(ForgotPassword, {}, void 0, false, {
        fileName: "/Users/yoyo/Downloads/PROSECare/src/main.jsx",
        lineNumber: 57,
        columnNumber: 12
      }, this)
    },
    {
      path: "/ResetPassword",
      element: /* @__PURE__ */ jsxDEV(ResetPassword, {}, void 0, false, {
        fileName: "/Users/yoyo/Downloads/PROSECare/src/main.jsx",
        lineNumber: 61,
        columnNumber: 12
      }, this)
    },
    {
      path: "/Success",
      element: /* @__PURE__ */ jsxDEV(Success, {}, void 0, false, {
        fileName: "/Users/yoyo/Downloads/PROSECare/src/main.jsx",
        lineNumber: 65,
        columnNumber: 12
      }, this)
    },
    {
      path: "/Courses",
      element: /* @__PURE__ */ jsxDEV(Courses, {}, void 0, false, {
        fileName: "/Users/yoyo/Downloads/PROSECare/src/main.jsx",
        lineNumber: 69,
        columnNumber: 12
      }, this)
    }
  ]
);
ReactDOM.createRoot(document.getElementById("root")).render(
  /* @__PURE__ */ jsxDEV(ChakraProvider, { children: /* @__PURE__ */ jsxDEV(React.StrictMode, { children: [
    /* @__PURE__ */ jsxDEV(RouterProvider, { router }, void 0, false, {
      fileName: "/Users/yoyo/Downloads/PROSECare/src/main.jsx",
      lineNumber: 76,
      columnNumber: 7
    }, this),
    /* @__PURE__ */ jsxDEV(ToastContainer, {}, void 0, false, {
      fileName: "/Users/yoyo/Downloads/PROSECare/src/main.jsx",
      lineNumber: 77,
      columnNumber: 7
    }, this)
  ] }, void 0, true, {
    fileName: "/Users/yoyo/Downloads/PROSECare/src/main.jsx",
    lineNumber: 75,
    columnNumber: 5
  }, this) }, void 0, false, {
    fileName: "/Users/yoyo/Downloads/PROSECare/src/main.jsx",
    lineNumber: 74,
    columnNumber: 3
  }, this)
);

//# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJtYXBwaW5ncyI6IkFBMkJhO0FBM0JiLE9BQU9BLFdBQVc7QUFDbEIsT0FBT0MsY0FBYztBQUNyQjtBQUFBLEVBQ0VDO0FBQUFBLEVBQ0FDO0FBQUFBLE9BQ0s7QUFDUCxPQUFPO0FBQ1AsT0FBT0MsU0FBUztBQUNoQixPQUFPQyxVQUFVO0FBQ2pCLE9BQU9DLGVBQWU7QUFDdEIsT0FBT0MsV0FBVztBQUNsQixPQUFPQyxvQkFBb0I7QUFDM0IsT0FBT0MsaUJBQWlCO0FBQ3hCLE9BQU9DLGlCQUFpQjtBQUN4QixPQUFPQyxhQUFhO0FBQ3BCLE9BQU9DLFlBQVk7QUFDbkIsT0FBT0Msb0JBQW9CO0FBQzNCLE9BQU9DLG1CQUFtQjtBQUMxQixPQUFPQyxhQUFhO0FBQ3BCLFNBQVNDLHNCQUFzQjtBQUMvQixTQUFTQyxnQkFBZ0JDLGFBQWE7QUFDdEMsT0FBTztBQUdQLE1BQU1DLFNBQVNqQjtBQUFBQSxFQUFvQjtBQUFBLElBQ2pDO0FBQUEsTUFDRWtCLE1BQU07QUFBQSxNQUNOQyxTQUFTLHVCQUFDLFNBQUQ7QUFBQTtBQUFBO0FBQUE7QUFBQSxhQUFJO0FBQUEsTUFDYkMsY0FBYyx1QkFBQyxlQUFEO0FBQUE7QUFBQTtBQUFBO0FBQUEsYUFBVTtBQUFBLElBQzFCO0FBQUEsSUFDQTtBQUFBLE1BQ0VGLE1BQU07QUFBQSxNQUNOQyxTQUFTLHVCQUFDLFVBQUQ7QUFBQTtBQUFBO0FBQUE7QUFBQSxhQUFLO0FBQUEsSUFDaEI7QUFBQSxJQUNBO0FBQUEsTUFDRUQsTUFBTTtBQUFBLE1BQ05DLFNBQVMsdUJBQUMsV0FBRDtBQUFBO0FBQUE7QUFBQTtBQUFBLGFBQU07QUFBQSxJQUNqQjtBQUFBLElBQ0E7QUFBQSxNQUNFRCxNQUFNO0FBQUEsTUFDTkMsU0FBUyx1QkFBQyxvQkFBRDtBQUFBO0FBQUE7QUFBQTtBQUFBLGFBQWU7QUFBQSxJQUMxQjtBQUFBLElBQ0E7QUFBQSxNQUNFRCxNQUFNO0FBQUEsTUFDTkMsU0FBUyx1QkFBQyxZQUFEO0FBQUE7QUFBQTtBQUFBO0FBQUEsYUFBTztBQUFBLElBQ2xCO0FBQUEsSUFDQTtBQUFBLE1BQ0VELE1BQU07QUFBQSxNQUNOQyxTQUFTLHVCQUFDLGlCQUFEO0FBQUE7QUFBQTtBQUFBO0FBQUEsYUFBWTtBQUFBLElBQ3ZCO0FBQUEsSUFDQTtBQUFBLE1BQ0VELE1BQU07QUFBQSxNQUNOQyxTQUFTLHVCQUFDLGlCQUFEO0FBQUE7QUFBQTtBQUFBO0FBQUEsYUFBWTtBQUFBLElBQ3ZCO0FBQUEsSUFDQTtBQUFBLE1BQ0VELE1BQU07QUFBQSxNQUNOQyxTQUFTLHVCQUFDLG9CQUFEO0FBQUE7QUFBQTtBQUFBO0FBQUEsYUFBZTtBQUFBLElBQzFCO0FBQUEsSUFDQTtBQUFBLE1BQ0VELE1BQU07QUFBQSxNQUNOQyxTQUFTLHVCQUFDLG1CQUFEO0FBQUE7QUFBQTtBQUFBO0FBQUEsYUFBYztBQUFBLElBQ3pCO0FBQUEsSUFDQTtBQUFBLE1BQ0VELE1BQU07QUFBQSxNQUNOQyxTQUFTLHVCQUFDLGFBQUQ7QUFBQTtBQUFBO0FBQUE7QUFBQSxhQUFRO0FBQUEsSUFDbkI7QUFBQSxJQUNBO0FBQUEsTUFDRUQsTUFBTTtBQUFBLE1BQ05DLFNBQVMsdUJBQUMsYUFBRDtBQUFBO0FBQUE7QUFBQTtBQUFBLGFBQVE7QUFBQSxJQUNuQjtBQUFBLEVBQUM7QUFDRjtBQUVEcEIsU0FBU3NCLFdBQVdDLFNBQVNDLGVBQWUsTUFBTSxDQUFDLEVBQUVDO0FBQUFBLEVBQ25ELHVCQUFDLGtCQUNDLGlDQUFDLE1BQU0sWUFBTixFQUNDO0FBQUEsMkJBQUMsa0JBQWUsVUFBaEI7QUFBQTtBQUFBO0FBQUE7QUFBQSxXQUErQjtBQUFBLElBQy9CLHVCQUFDLG9CQUFEO0FBQUE7QUFBQTtBQUFBO0FBQUEsV0FBZTtBQUFBLE9BRmpCO0FBQUE7QUFBQTtBQUFBO0FBQUEsU0FHQSxLQUpGO0FBQUE7QUFBQTtBQUFBO0FBQUEsU0FLQTtBQUNGIiwibmFtZXMiOlsiUmVhY3QiLCJSZWFjdERPTSIsImNyZWF0ZUJyb3dzZXJSb3V0ZXIiLCJSb3V0ZXJQcm92aWRlciIsIkFwcCIsIlJvb3QiLCJFcnJvclBhZ2UiLCJMb2dpbiIsIkNoYW5nZVBhc3N3b3JkIiwiQWNjb3VudFR5cGUiLCJWZXJpZnlFbWFpbCIsIlN1Y2Nlc3MiLCJTaWduVXAiLCJGb3Jnb3RQYXNzd29yZCIsIlJlc2V0UGFzc3dvcmQiLCJDb3Vyc2VzIiwiQ2hha3JhUHJvdmlkZXIiLCJUb2FzdENvbnRhaW5lciIsInRvYXN0Iiwicm91dGVyIiwicGF0aCIsImVsZW1lbnQiLCJlcnJvckVsZW1lbnQiLCJjcmVhdGVSb290IiwiZG9jdW1lbnQiLCJnZXRFbGVtZW50QnlJZCIsInJlbmRlciJdLCJzb3VyY2VzIjpbIm1haW4uanN4Il0sInNvdXJjZXNDb250ZW50IjpbImltcG9ydCBSZWFjdCBmcm9tICdyZWFjdCdcbmltcG9ydCBSZWFjdERPTSBmcm9tICdyZWFjdC1kb20vY2xpZW50J1xuaW1wb3J0IHtcbiAgY3JlYXRlQnJvd3NlclJvdXRlcixcbiAgUm91dGVyUHJvdmlkZXIsXG59IGZyb20gXCJyZWFjdC1yb3V0ZXItZG9tXCI7XG5pbXBvcnQgJy4vaW5kZXguY3NzJ1xuaW1wb3J0IEFwcCBmcm9tICcuL0FwcC5qc3gnXG5pbXBvcnQgUm9vdCBmcm9tICcuL3JvdXRlcy9yb290LnRzeCc7XG5pbXBvcnQgRXJyb3JQYWdlIGZyb20gXCIuL2Vycm9yLXBhZ2VcIjtcbmltcG9ydCBMb2dpbiBmcm9tICcuL0xvZ2luJztcbmltcG9ydCBDaGFuZ2VQYXNzd29yZCBmcm9tICcuL0NoYW5nZVBhc3N3b3JkJ1xuaW1wb3J0IEFjY291bnRUeXBlIGZyb20gJy4vQWNjb3VudFR5cGUnXG5pbXBvcnQgVmVyaWZ5RW1haWwgZnJvbSAnLi9WZXJpZnlFbWFpbCdcbmltcG9ydCBTdWNjZXNzIGZyb20gJy4vU3VjY2VzcydcbmltcG9ydCBTaWduVXAgZnJvbSAnLi9TaWduVXAnXG5pbXBvcnQgRm9yZ290UGFzc3dvcmQgZnJvbSAnLi9Gb3Jnb3RQYXNzd29yZCdcbmltcG9ydCBSZXNldFBhc3N3b3JkIGZyb20gJy4vUmVzZXRQYXNzd29yZCdcbmltcG9ydCBDb3Vyc2VzIGZyb20gJy4vQ291cnNlcydcbmltcG9ydCB7IENoYWtyYVByb3ZpZGVyIH0gZnJvbSAnQGNoYWtyYS11aS9yZWFjdCdcbmltcG9ydCB7IFRvYXN0Q29udGFpbmVyLCB0b2FzdCB9IGZyb20gJ3JlYWN0LXRvYXN0aWZ5JztcbmltcG9ydCAncmVhY3QtdG9hc3RpZnkvZGlzdC9SZWFjdFRvYXN0aWZ5LmNzcyc7XG5cblxuY29uc3Qgcm91dGVyID0gY3JlYXRlQnJvd3NlclJvdXRlcihbXG4gIHtcbiAgICBwYXRoOiBcIi9cIixcbiAgICBlbGVtZW50OiA8QXBwIC8+LFxuICAgIGVycm9yRWxlbWVudDogPEVycm9yUGFnZSAvPixcbiAgfSxcbiAge1xuICAgIHBhdGg6IFwiL0Rhc2hib2FyZC86c2VjdGlvbklkXCIsXG4gICAgZWxlbWVudDogPFJvb3QgLz4sXG4gIH0sXG4gIHtcbiAgICBwYXRoOiBcIi9Mb2dpblwiLFxuICAgIGVsZW1lbnQ6IDxMb2dpbiAvPixcbiAgfSxcbiAge1xuICAgIHBhdGg6IFwiL0NoYW5nZVBhc3N3b3JkXCIsXG4gICAgZWxlbWVudDogPENoYW5nZVBhc3N3b3JkIC8+LFxuICB9LFxuICB7XG4gICAgcGF0aDogXCIvU2lnblVwXCIsXG4gICAgZWxlbWVudDogPFNpZ25VcCAvPixcbiAgfSxcbiAge1xuICAgIHBhdGg6IFwiL0FjY291bnRUeXBlXCIsXG4gICAgZWxlbWVudDogPEFjY291bnRUeXBlIC8+LFxuICB9LFxuICB7XG4gICAgcGF0aDogXCIvVmVyaWZ5RW1haWxcIixcbiAgICBlbGVtZW50OiA8VmVyaWZ5RW1haWwgLz4sXG4gIH0sXG4gIHtcbiAgICBwYXRoOiBcIi9Gb3Jnb3RQYXNzd29yZFwiLFxuICAgIGVsZW1lbnQ6IDxGb3Jnb3RQYXNzd29yZCAvPixcbiAgfSxcbiAge1xuICAgIHBhdGg6IFwiL1Jlc2V0UGFzc3dvcmRcIixcbiAgICBlbGVtZW50OiA8UmVzZXRQYXNzd29yZCAvPixcbiAgfSxcbiAge1xuICAgIHBhdGg6IFwiL1N1Y2Nlc3NcIixcbiAgICBlbGVtZW50OiA8U3VjY2VzcyAvPixcbiAgfSxcbiAge1xuICAgIHBhdGg6IFwiL0NvdXJzZXNcIixcbiAgICBlbGVtZW50OiA8Q291cnNlcyAvPixcbiAgfSxcbl0pO1xuXG5SZWFjdERPTS5jcmVhdGVSb290KGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdyb290JykpLnJlbmRlcihcbiAgPENoYWtyYVByb3ZpZGVyPlxuICAgIDxSZWFjdC5TdHJpY3RNb2RlPlxuICAgICAgPFJvdXRlclByb3ZpZGVyIHJvdXRlcj17cm91dGVyfSAvPlxuICAgICAgPFRvYXN0Q29udGFpbmVyIC8+XG4gICAgPC9SZWFjdC5TdHJpY3RNb2RlPlxuICA8L0NoYWtyYVByb3ZpZGVyPlxuKVxuIl0sImZpbGUiOiIvVXNlcnMveW95by9Eb3dubG9hZHMvUFJPU0VDYXJlL3NyYy9tYWluLmpzeCJ9