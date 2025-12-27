# PAN Resizer AdStyle - সম্পূর্ণ Ad Placement গাইড

## 📍 সব Ad types এবং তাদের Display Location

### 1. 📍 **Social Bar Ad**
- **স্থান:** Website এর left/right side
- **Display:** সবসময় visible (sticky position)
- **Desktop:** Yes ✅
- **Mobile:** Yes ✅ (স্বয়ংক্রিয়ভাবে top এ চলে আসে)
- **কখন দেখা যাবে:** User যখন page scroll করবে

---

### 2. ⬆️ **Popunder Ad**
- **স্থান:** Background এ popup window হিসেবে
- **Display:** User interaction এর পর (click, hover, etc)
- **Desktop:** Yes ✅
- **Mobile:** Yes ✅
- **কখন দেখা যাবে:** AdStyle code trigger করার সময়

---

### 3. 📌 **Banner Ads (১০টি স্লট)**
প্রতিটি banner ads স্বয়ংক্রিয়ভাবে content sections এর মধ্যে রাখা হবে:

#### **Banner 1** 🔴 - Hero ↔ Editor
#### **Banner 2** 🟠 - Editor ↔ Presets
#### **Banner 3** 🟡 - Presets (মধ্যে)
#### **Banner 4** 🟢 - Presets ↔ Specs
#### **Banner 5** 🔵 - Specs ↔ Features
#### **Banner 6** 🟣 - Features (মধ্যে)
#### **Banner 7** ⚫ - Features ↔ How-to
#### **Banner 8** ⚪ - How-to (মধ্যে)
#### **Banner 9** 🟥 - How-to ↔ FAQ
#### **Banner 10** 🟨 - FAQ (মধ্যে)

- **প্রতিটি banner:** Horizontal format
- **Display:** সবসময়
- **Desktop:** Yes ✅
- **Mobile:** Yes ✅ (Responsive)
- **Size:** AdStyle code নিজেই size handle করবে

---

### 4. 🏷️ **Native Banner Ad**
- **স্থান:** Content এর সাথে integrated (পাশাপাশি)
- **Display:** সবসময়
- **Desktop:** Yes ✅
- **Mobile:** Yes ✅
- **মাপ:** Flexible (code অনুযায়ী)

---

### 5. 🔗 **Smart Link Ad**
- **স্থান:** Header এর "Online PAN Resizer" text এ hyperlink হিসেবে
- **Display:** সবসময়
- **Desktop:** Yes ✅
- **Mobile:** Yes ✅
- **কাজ:** Click করলে আপনার link open হবে

---

## ❓ আপনার প্রশ্নের উত্তর

### **Q1: "Sidebar Ad কি?"**
আপনি যা বোঝাতে চাইলেন তা হল **"Desktop এ left/right side এ fixed থাকবে"** - এটা **Social Bar Ad**।

✅ **Desktop (1024px+):** Left/right side এ fixed থাকবে
✅ **Mobile (768px-):** Top এ চলে আসবে (responsive)

Plugin এ এটা automatic handle করে দিয়েছি CSS এ।

---

### **Q2: "একই banner ad code বারবার ব্যবহার করলে কি সমস্যা হবে?"**

**🎉 না, কোনো সমস্যা হবে না!**

আপনি একই ad code ১০টি banner slot এ paste করতে পারেন:
- ✅ কোনো conflict নেই
- ✅ Multiple times display হবে (page এ ১০বার দেখা যাবে)
- ✅ AdStyle এটা support করে
- ✅ Different URLs handle করবে (প্রতিটা জায়গার জন্য different tracking)

### **উদাহরণ:**
```
Banner 1: [AdStyle Code A]
Banner 2: [AdStyle Code A] ← একই code
Banner 3: [AdStyle Code A] ← একই code
...
```

এটা পুরোপুরি ঠিক আছে! AdStyle automatically track করবে কোথা থেকে clicks আসছে।

---

## 📊 সারসংক্ষেপ - সব Ad Types

| Ad Type | Position | Desktop | Mobile | Quantity |
|---------|----------|---------|--------|----------|
| Social Bar | Side (fixed) | ✅ | ✅ | 1 |
| Popunder | Popup | ✅ | ✅ | 1 |
| Banner Ads | Between sections | ✅ | ✅ | 10 |
| Native Banner | Content inside | ✅ | ✅ | 1 |
| Smart Link | Header text | ✅ | ✅ | 1 |

---

## 🚀 কীভাবে install করবেন:

1. **Theme:** `pan-resizer-theme.zip` upload করুন WordPress এ
2. **Plugin:** `pan-resizer-ads.zip` upload করুন
3. **Plugin activate** করুন
4. **Appearance → PAN Resizer → Ads Manager** যান
5. AdStyle ad codes paste করুন
6. Save করুন - শেষ! 🎉

---

## 💡 প্রো টিপস:

- একই ad code multiple times use করতে পারেন
- Desktop-only ads চাইলে CSS customize করা যায়
- Mobile-only ads চাইলেও করা যায় (বলে দিন)
- সব ads auto-responsive
