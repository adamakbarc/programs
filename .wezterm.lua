local wez = require 'wezterm'
local conf = {}

if wez.config_builder then
  conf = wez.config_builder()
end

conf.window_decorations = 'RESIZE'

--conf.default_domain = 'WSL:Ubuntu'
--conf.default_prog = { 'cmd.exe', '/k C:/shell.bat' }
--conf.default_prog = { 'cmd.exe ', "/k", "C:\\msys64\\msys2_shell.cmd -defterm -here -no-start -ucrt64 -shell bash " }
--conf.default_prog = { 'zsh', '-l' }
--conf.default_prog = { 'cmd.exe' }
--conf.default_cwd = 'C:/data'

conf.default_prog = { 'powershell.exe' }
conf.font = wez.font('JetBrains Mono')
conf.font_size = 11
conf.use_fancy_tab_bar = false
conf.harfbuzz_features = { 'calt=0' }

conf.colors = {
  foreground = '#b2b2b2',
  background = '#080808',
  cursor_bg = '#9e9e9e',
  cursor_fg = '#080808',
  cursor_border = '#080808', -- might change this
  selection_fg = '#080808',
  selection_bg = 'b2ceee',
  ansi = {
    '#323437',
    '#ff5454',
    '#8cc85f',
    '#e3c78a',
    '#80a0ff',
    '#cf87e8',
    '#80a0ff',
    '#c6c6c6',
  },
  brights = {
    '#949494',
    '#ff5189',
    '#36c692',
    '#c2c292',
    '#74b2ff',
    '#ae81ff',
    '#85dc85',
    '#e4e4e4',
  },
  split = '#ffffff',
}

conf.inactive_pane_hsb = {
  saturation = 1.0,
  brightness = 1.0,
}

conf.window_padding = {
  left = 0,
  right = 0,
  top = 0,
  bottom = 0,
}

conf.keys = {
  {
    key = 'v',
    mods = 'CTRL',
    action = wez.action.PasteFrom 'Clipboard',
  },
  {
    key = 'l',
    mods = 'ALT|CTRL',
    action = wez.action.SplitHorizontal { domain = 'CurrentPaneDomain' },
  },
  {
    key = 'j',
    mods = 'ALT|CTRL',
    action = wez.action.SplitVertical { domain = 'CurrentPaneDomain' },
  },
  {
    key = 'h',
    mods = 'ALT',
    action = wez.action.ActivatePaneDirection 'Left',
  },
  {
    key = 'j',
    mods = 'ALT',
    action = wez.action.ActivatePaneDirection 'Down',
  },
  {
    key = 'k',
    mods = 'ALT',
    action = wez.action.ActivatePaneDirection 'Up',
  },
  {
    key = 'l',
    mods = 'ALT',
    action = wez.action.ActivatePaneDirection 'Right',
  },
  {
    key = 'z',
    mods = 'ALT',
    action = wez.action.TogglePaneZoomState,
  },
  {
    key = 'n',
    mods = 'CTRL|ALT',
    action = wez.action.SpawnTab 'CurrentPaneDomain',
  },
  {
    key = 'w',
    mods = 'CTRL',
    action = wez.action.CloseCurrentTab { confirm = true },
  },
  {
    key = '1',
    mods = 'ALT',
    action = wez.action.ActivateTab(0),
  },
  {
    key = '2',
    mods = 'ALT',
    action = wez.action.ActivateTab(1),
  },
  {
    key = '3',
    mods = 'ALT',
    action = wez.action.ActivateTab(2),
  },
  {
    key = '4',
    mods = 'ALT',
    action = wez.action.ActivateTab(3),
  },
  {
    key = '5',
    mods = 'ALT',
    action = wez.action.ActivateTab(4),
  },
  {
    key = 'y',
    mods = 'ALT|CTRL',
    action = wez.action.ActivateCopyMode,
  },
}

return conf
