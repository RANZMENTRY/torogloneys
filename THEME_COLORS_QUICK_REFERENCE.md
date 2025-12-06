# Filament Theme Colors - Quick Reference

## 🎨 Current Color Configuration

```php
// Location: app/Providers/Filament/AdminPanelProvider.php

->colors([
    'primary' => Color::Emerald,    // #10b981 - Main theme
    'success' => Color::Emerald,    // #10b981 - Success state
    'warning' => Color::Amber,      // #f59e0b - Warning
    'danger'  => Color::Rose,       // #f43f5e - Danger/Error
    'info'    => Color::Sky,        // #0ea5e9 - Information
    'gray'    => Color::Slate,      // #64748b - Neutral
])
```

## 🌿 Color Palette Overview

| Color | Hex | Usage | Feeling |
|-------|-----|-------|---------|
| Emerald | #10b981 | Primary, Success | Fresh, Natural, Growth |
| Amber | #f59e0b | Warning | Caution, Attention |
| Rose | #f43f5e | Danger | Alert, Error |
| Sky | #0ea5e9 | Info | Information, Trust |
| Slate | #64748b | Gray | Neutral, Disabled |

## 🎯 Green Shades Comparison

```
Emerald  #10b981  ✅ Natural, perfect for plants
Green    #22c55e  ⚠️  Too bright
Lime     #84cc16  ❌ Too yellow
Teal     #14b8a6  ❌ Too blue
```

## 🔄 How to Change Colors

Edit this section in `app/Providers/Filament/AdminPanelProvider.php`:

```php
->colors([
    'primary'   => Color::Emerald,    // Change primary color here
    'success'   => Color::Emerald,    // Change success color here
    'warning'   => Color::Amber,      // Change warning color here
    'danger'    => Color::Rose,       // Change danger color here
    'info'      => Color::Sky,        // Change info color here
    'gray'      => Color::Slate,      // Change gray color here
])
```

Then refresh your browser (no restart needed).

## 📋 Alternative Palettes

### Bold Nature
```php
'primary'   => Color::Green,
'success'   => Color::Emerald,
'warning'   => Color::Yellow,
'danger'    => Color::Red,
'info'      => Color::Blue,
'gray'      => Color::Gray,
```

### Tropical
```php
'primary'   => Color::Teal,
'success'   => Color::Emerald,
'warning'   => Color::Amber,
'danger'    => Color::Orange,
'info'      => Color::Cyan,
'gray'      => Color::Slate,
```

### Minimalist
```php
'primary'   => Color::Emerald,
'success'   => Color::Emerald,
'warning'   => Color::Amber,
'danger'    => Color::Rose,
'info'      => Color::Slate,
'gray'      => Color::Slate,
```

## 🎨 Available Colors in Filament

```
Green Family:    Emerald, Green, Lime, Teal, Cyan
Warm Family:     Amber, Orange, Yellow, Rose, Red
Cool Family:     Sky, Blue, Indigo, Violet, Purple
Neutral Family:  Gray, Slate, Zinc, Stone
```

## ✅ Where Colors Are Used

- **Primary:** Buttons, links, active states, primary actions
- **Success:** Checkmarks, success messages, positive actions
- **Warning:** Warning messages, cautions, alerts
- **Danger:** Delete buttons, error states, critical actions
- **Info:** Info badges, notifications, hints
- **Gray:** Disabled states, borders, neutral elements

## 📚 Full Documentation

See `FILAMENT_THEME_COLORS_GUIDE.md` for complete guide with color psychology, shade breakdowns, and detailed examples.

---

**Last Updated:** December 6, 2025
**Status:** ✅ Production Ready
