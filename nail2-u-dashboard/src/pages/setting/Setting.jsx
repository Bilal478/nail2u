import "./setting.css";
import { NavLink } from "react-router-dom";
import settingicon from "../setting/settingsicon.svg";
import notificationicon from "../setting/notificationicon.svg";
import supporticon from "../setting/supporticon.svg";
import usericon from "../setting/usericon.svg";
import walleticon from "../setting/walleticon.svg";
import SettingsContent from "./SettingsContent";

export default function Setting() {
  return (
    <div className="setting">
      <div className="customerDetails">
        <div className="card card-outline-secondary">
          <div className="card-header">
            <h3 className=" mb-0 ">Settings</h3>
          </div>
          <div className="setting-div">
            <div className="setting-sidebar">
              <div className="setting-wrapper">
                <div className="setting-menu">
                  <div className="setting-display">
                    <NavLink
                      to="/dashboard/setting/general-setting"
                      className="setting-menu-container "
                      activeClassName="setting-active"
                    >
                      <div>
                        <img src={settingicon} alt="" />
                        <p>General settings</p>
                      </div>
                    </NavLink>
                    <NavLink
                      to="/dashboard/setting/alert-notification"
                      activeClassName="setting-active"
                      className="setting-menu-container ml-3"
                    >
                      <div>
                        <img src={notificationicon} alt="" />
                        <p>Alert Notification</p>
                      </div>
                    </NavLink>
                  </div>

                  <div className="setting-display">
                    <NavLink
                      to="/dashboard/setting/payment-setting"
                      className="setting-menu-container mt-3"
                      activeClassName="setting-active"
                    >
                      <div>
                        <img src={walleticon} alt="" />
                        <p>Payment settings</p>
                      </div>
                    </NavLink>

                    <NavLink
                      to="/dashboard/setting/support-setting"
                      className="setting-menu-container ml-3 mt-3"
                      activeClassName="setting-active"
                    >
                      <div>
                        <img src={supporticon} alt="" />
                        <p>support settings</p>
                      </div>
                    </NavLink>
                  </div>
                  <div className="setting-display">
                    <NavLink
                      to="/dashboard/setting/profile-setting"
                      className="setting-menu-container  mt-3"
                      activeClassName="setting-active"
                    >
                      <div>
                        <img src={usericon} alt="" />
                        <p>profile settings</p>
                      </div>
                    </NavLink>
                  </div>
                </div>
              </div>
            </div>
            <div className="setting-content ">
              <SettingsContent />
            </div>
          </div>
        </div>
      </div>
    </div>
  );
}
